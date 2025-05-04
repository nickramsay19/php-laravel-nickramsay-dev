<?php
 
namespace App\Providers;
 
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Role;
use App\Models\User;
use App\Policies\PostPolicy;
use App\Policies\TagPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
 
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
        User::class => UserPolicy::class,
    ];
 
    /**
     * Register any application authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        Auth::macro('permissions', function () {
            if (!Auth::check()) {
                return new Collection();
            }
            return Auth::user()->permissions()->pluck('name');
        });

        Auth::macro('can', function (string $policy, mixed $object) {
            if (!Auth::check()) {
                return Gate::check($policy, $object);
            }
            return Auth::user()->can($policy, $object);
        });

        $this->registerPolicies();
    }
}