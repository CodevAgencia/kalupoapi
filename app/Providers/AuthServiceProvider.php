<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Policies\PetPolicy;
use App\Policies\PetPqrsPolicy;
use App\Policies\UserAddressPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::resource('user-address', UserAddressPolicy::class);
        Gate::resource('pet', PetPolicy::class);
        Gate::resource('pet-pqrs', PetPqrsPolicy::class);
    }
}
