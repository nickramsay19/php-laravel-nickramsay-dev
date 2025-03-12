<?php
 
namespace App\Providers;
 
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
 
class GuestServiceProvider extends ServiceProvider {
    public function boot() {
        // laravel policies only work if the user isn't null so for guest access we need to assign a dummy user.
        // from now on to check for guest use is_null(Auth::user()->getKey())
        if(!Auth::check()) {
            $userClass = config('auth.providers.users.model');
            Auth::setUser(new $userClass());
        }
    }
}

