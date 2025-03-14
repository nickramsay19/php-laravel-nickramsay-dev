<?php
 
namespace App\Providers;
 
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Role;
use App\Policies\PostPolicy;
use App\Policies\TagPolicy;
use App\Policies\RolePolicy;
 
class AuthServiceProvider extends ServiceProvider {
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Tag::class => TagPolicy::class,
        Role::class => RolePolicy::class,
    ];
 
    /**
     * Register any application authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        Auth::macro('permissions', function () {
            if (!Auth::check()) {
                return Role::firstWhere('name', 'guest')->permissions()->pluck('name');
            }
            return Auth::user()->permissions()->pluck('name');
        });

        $this->registerPolicies();
    }
}