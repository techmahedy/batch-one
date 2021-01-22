<?php

namespace App\Providers;

use App\Repository\Doctor\IDoctor;
use Illuminate\Support\ServiceProvider;
use App\Repository\Doctor\DoctorRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IDoctor::class,DoctorRepository::class);
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
