<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasDevice
{
    /**
     * @return MorphMany
     */
    abstract protected function devices(): MorphMany;

    public function routeNotificationForExpo(): array
    {
        return $this->devices->pluck('token')->toArray();
    }


    /**
     * @param array{token: string, name: string} $device
     * @return Model
     */
    public function associateDevice(array $device): Model
    {
        return $this->devices()->updateOrCreate(['token' => $device['token']], $device);
    }

    public function removeDevice(string $token): ?bool
    {
        return $this->devices()->whereToken($token)->first()?->delete();
    }
}
