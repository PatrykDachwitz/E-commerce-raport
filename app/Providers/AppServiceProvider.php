<?php
declare(strict_types=1);
namespace App\Providers;

use App\Repository\Eloquent\UserRepository;
use App\Repository\UserRepository as UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class,
        );


    }
}
