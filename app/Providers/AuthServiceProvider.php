<?php

namespace App\Providers;

use App\Models\FootballClub;
use App\Models\User;
use Faker\Core\Number;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('see-club', function (User $user, FootballClub $club) {
            return $user->id === $club->user_id;
        });
        Gate::define('edit-club', function (User $user, FootballClub $club) {
            return $user->id === $club->user_id;
        });
        Gate::define('add-club', function (User $user, User $userCurrent) {
            return $user->id == $userCurrent->id;
        });
    }
}
