<?php

namespace App\Models;

use App\Notifications\SendResetPasswordCodeNotification;
use App\Objects\Enums\ResetCodeType;
use App\Traits\HasDevice;
use App\Traits\HasResetCodes;
use Exception;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Contracts\User\UserContract;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Passport\PersonalAccessTokenResult;

class User extends Authenticatable implements UserContract
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasResetCodes;
    use HasDevice;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

        /**
     * Hashes and updates the user's password.
     *
     * @param string $password Plain-text password
     */
    public function setPassword(string $password): void
    {
        $this->update([
            'password' => Hash::make($password),
        ]);

    }

    /**
     * @param array{email?:string, dni?: string, name?: string, last_name?: string, nit?: string, business_name?: string, is_professional: bool, experience?: float, fee?: float, profession_id?: int} $attributes
     * @return void
     */
    public function setAttributes(array $attributes): void
    {
        $this->update([
            ...$attributes,
        ]);
    }

    public function updateAvatar(UploadedFile $file): void
    {
        if (Storage::disk()->exists($this->avatar)) {
            Storage::delete($this->avatar);
        }
        $path = Storage::put('avatars', $file);

        $this->update(['avatar' => $path]);
    }

    public function getAvatar($avatar): ?string
    {
        if (!is_null($avatar)) {
            if (Storage::disk()->exists($avatar)) {
                return config('filesystems.default') === "s3" ? Storage::url($avatar) : url(Storage::url($avatar));
            }
            return '';
        }
        return $avatar;
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $this->getAvatar($value),
        );
    }

    public function destroyMe(): void
    {
        $this->delete();
    }

    /**
     * @param string $name
     * @return PersonalAccessTokenResult
     */
    public function generateToken(string $name): PersonalAccessTokenResult
    {
        return $this->createToken($name);
    }

    public function sendResetPasswordNotification(string $code): void
    {
        $this->notify(new SendResetPasswordCodeNotification($this->name, $code));
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * @throws Exception
     */
    public function sendResetCode(): bool
    {
        $code = $this->generateCode(ResetCodeType::RESET_CODE);

        $this->sendResetPasswordNotification($code);

        return true;
    }

    public function resetCode(): ?UserResetCodes
    {
        return $this->resetCodes()->where('type', ResetCodeType::RESET_CODE)->first();
    }

    /**
     * @throws Exception
     */
    public function generateResetCode(): bool
    {
        $code = $this->generateCode(ResetCodeType::RESET_CODE);

        $this->sendResetPasswordNotification($code);

        return true;
    }

    public function me(): array
    {
        return [
            'id' => $this->id,
            'avatar' => $this->avatar,
            'email' => $this->email,
            'phone' => $this->phone,
            'name' => $this->name,
            'last_name' => $this->last_name,
        ];
    }

    /** Relationships */

    public function devices(): MorphMany
    {
        return $this->morphMany(Device::class, 'deviceable');
    }

    public function userAddress(): HasMany
    {
        return $this->hasMany(UserAddress::class);
    }

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }
}
