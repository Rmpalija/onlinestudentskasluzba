<?php

namespace App\Providers;

use App\Role;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        
        // Auth gates for: Upravljanje korisnicima
        Gate::define('upravljanje_korisnicima_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Ispiti
        Gate::define('ispiti_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 6]);
        });
        Gate::define('ispiti_create', function ($user) {
            return in_array($user->role_id, [1, 4, 6]);
        });
        Gate::define('ispiti_edit', function ($user) {
            return in_array($user->role_id, [1, 4, 6]);
        });
        Gate::define('ispiti_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 6]);
        });
        Gate::define('ispiti_delete', function ($user) {
            return in_array($user->role_id, [1, 4, 6]);
        });

        // Auth gates for: Fakulteti
        Gate::define('fakulteti_access', function ($user) {
            return in_array($user->role_id, [1, 6]);
        });
        Gate::define('fakulteti_create', function ($user) {
            return in_array($user->role_id, [1, 6]);
        });
        Gate::define('fakulteti_edit', function ($user) {
            return in_array($user->role_id, [1, 6]);
        });
        Gate::define('fakulteti_view', function ($user) {
            return in_array($user->role_id, [1, 6]);
        });
        Gate::define('fakulteti_delete', function ($user) {
            return in_array($user->role_id, [1, 6]);
        });

        // Auth gates for: Predmeti
        Gate::define('predmeti_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 6]);
        });
        Gate::define('predmeti_create', function ($user) {
            return in_array($user->role_id, [1, 6]);
        });
        Gate::define('predmeti_edit', function ($user) {
            return in_array($user->role_id, [1, 6]);
        });
        Gate::define('predmeti_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 6]);
        });
        Gate::define('predmeti_delete', function ($user) {
            return in_array($user->role_id, [1, 6]);
        });

        // Auth gates for: Profesori
        Gate::define('profesori_access', function ($user) {
            return in_array($user->role_id, [1, 4, 6]);
        });
        Gate::define('profesori_create', function ($user) {
            return in_array($user->role_id, [1, 6]);
        });
        Gate::define('profesori_edit', function ($user) {
            return in_array($user->role_id, [1, 6]);
        });
        Gate::define('profesori_view', function ($user) {
            return in_array($user->role_id, [1, 4, 6]);
        });
        Gate::define('profesori_delete', function ($user) {
            return in_array($user->role_id, [1, 6]);
        });

        // Auth gates for: Studenti
        Gate::define('studenti_access', function ($user) {
            return in_array($user->role_id, [1, 6]);
        });
        Gate::define('studenti_create', function ($user) {
            return in_array($user->role_id, [1, 6]);
        });
        Gate::define('studenti_edit', function ($user) {
            return in_array($user->role_id, [1, 6]);
        });
        Gate::define('studenti_view', function ($user) {
            return in_array($user->role_id, [1, 6]);
        });
        Gate::define('studenti_delete', function ($user) {
            return in_array($user->role_id, [1, 6]);
        });

        // Auth gates for: Skolarina
        Gate::define('skolarina_access', function ($user) {
            return in_array($user->role_id, [1, 5, 3, 6]);
        });
        Gate::define('skolarina_create', function ($user) {
            return in_array($user->role_id, [1, 5, 3]);
        });
        Gate::define('skolarina_edit', function ($user) {
            return in_array($user->role_id, [1, 5, 3]);
        });
        Gate::define('skolarina_view', function ($user) {
            return in_array($user->role_id, [1, 5, 3, 6]);
        });
        Gate::define('skolarina_delete', function ($user) {
            return in_array($user->role_id, [1, 5]);
        });

    }
}
