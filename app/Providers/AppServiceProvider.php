<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Status
         */
        $this->app->singleton(
            \App\Contracts\Status\StatusContract::class,
            \App\Repositories\Status\StatusRepository::class
        );

        /**
         * User
         */
        $this->app->singleton(
            \App\Contracts\User\UserContract::class,
            \App\Repositories\User\UserRepository::class
        );

        /**
         * Activity
         */
        $this->app->singleton(
            \App\Contracts\Activity\ActivityContract::class,
            \App\Repositories\Activity\ActivityRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
