<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
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
        Model::preventLazyLoading(); //lazyloading is false (good for performance 1 by 1 execute query). when lazy loading will trigger error
        // Paginator::useBootstrapFive();
        // Gate::define('edit-job', function (User $user, Job $job) { //this is laravel function which define a house Gate , if User user infront put ? it similar as $user = null and access function validate
        //     return $job->employer->user->is($user); // show boolean
        // });
    }
}
