<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // 🔑 Gate para Admin
        Gate::define('admin', fn(User $user) => $user->role === 'admin');

        // 🔑 Gate para Operador
        Gate::define('operador', fn(User $user) => $user->role === 'operador');

        // 🔑 Gate para Inspector
        Gate::define('inspector', fn(User $user) => $user->role === 'inspector');
    }
}
