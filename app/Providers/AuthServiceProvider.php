<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use App\Models\File;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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

        Gate::define("delete-file", function (User $auth_user, File $file, User $file_user) {
            if ($auth_user->hasRole("admin")) {
                return true;
            }
            if ($auth_user->hasRole("moderator")) {
              return !$file_user->hasRole('admin') && !($auth_user->id !== $file_user->id);
            }
            return !$auth_user->hasRole('user');
        });

    }
}
