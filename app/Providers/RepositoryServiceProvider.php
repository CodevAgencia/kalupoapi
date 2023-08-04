<?php

namespace App\Providers;

use App\Contracts\Auth\AuthRepositoryContract;
use App\Contracts\Auth\SocialAuthRepositoryContract;
use App\Contracts\Brands\BrandRepositoryContract;
use App\Contracts\Categories\CategoryRepositoryContract;
use App\Contracts\LandingPage\LandingPageRepositoryContract;
use App\Contracts\PetAges\PetAgeRepositoryContract;
use App\Contracts\Pets\PetContract;
use App\Contracts\Pets\PetRepositoryContract;
use App\Contracts\PetPqrs\PetPqrsContract;
use App\Contracts\PetPqrs\PetPqrsRepositoryContract;
use App\Contracts\PetTypes\PetTypeRepositoryContract;
use App\Contracts\Products\ProductContract;
use App\Contracts\Products\ProductRepositoryContract;
use App\Contracts\References\ReferenceRepositoryContract;
use App\Contracts\SubCategories\SubCategoryRepositoryContract;
use App\Contracts\User\UserContract;
use App\Contracts\User\UserRepositoryContract;
use App\Models\PetPqrs;
use App\Models\Pet;
use App\Contracts\UserAddress\UserAddressContract;
use App\Contracts\UserAddress\UserAddressRepositoryContract;
use App\Models\Product;
use App\Models\User;
use App\Models\UserAddress;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\SocialAuthRepository;
use App\Repositories\Brands\BrandRepository;
use App\Repositories\Categories\CategoryRepository;
use App\Repositories\LandingPage\LandingPageRepository;
use App\Repositories\PetAges\PetAgeRepository;
use App\Repositories\Pets\PetRepository;
use App\Repositories\PetPqrs\PetPqrsRepository;
use App\Repositories\PetTypes\PetTypeRepository;
use App\Repositories\Products\ProductRepository;
use App\Repositories\References\ReferenceRepository;
use App\Repositories\SubCategories\SubCategoryRepository;
use App\Repositories\UserAddress\UserAddressRepository;
use App\Repositories\Users\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserContract::class, User::class);
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(AuthRepositoryContract::class, AuthRepository::class);
        $this->app->bind(SocialAuthRepositoryContract::class, SocialAuthRepository::class);

        $this->app->bind(LandingPageRepositoryContract::class, LandingPageRepository::class);

        $this->app->bind(CategoryRepositoryContract::class, CategoryRepository::class);

        $this->app->bind(SubCategoryRepositoryContract::class, SubCategoryRepository::class);

        $this->app->bind(PetTypeRepositoryContract::class, PetTypeRepository::class);

        $this->app->bind(BrandRepositoryContract::class, BrandRepository::class);

        $this->app->bind(PetAgeRepositoryContract::class, PetAgeRepository::class);

        $this->app->bind(UserAddressRepositoryContract::class, UserAddressRepository::class);
        $this->app->bind(UserAddressContract::class, UserAddress::class);

        $this->app->bind(ReferenceRepositoryContract::class, ReferenceRepository::class);

        $this->app->bind(ProductContract::class, Product::class);
        $this->app->bind(ProductRepositoryContract::class, ProductRepository::class);

        $this->app->bind(PetRepositoryContract::class, PetRepository::class);
        $this->app->bind(PetContract::class, Pet::class);

        // $this->app->bind(PetPqrsContract::class, PetPqrs::class);
        $this->app->bind(PetPqrsRepositoryContract::class, PetPqrsRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
