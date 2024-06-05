<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Request as MyRequest;
use App\Models\Tracking;
use App\Models\User;
use App\Models\Building;
use App\Models\UserType;
use App\Policies\RequestPolicy;
use App\Policies\TrackingPolicy;
use App\Policies\UserPolicy;
use App\Policies\UserTypePolicy;
use App\Policies\BuildingPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        MyRequest::class => RequestPolicy::class,
        Tracking::class => TrackingPolicy::class,
        User::class => UserPolicy::class,
        UserType::class => UserTypePolicy::class,
        Building::class => BuildingPolicy::class,

        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
