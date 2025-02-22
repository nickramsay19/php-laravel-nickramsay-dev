<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider {
    public function register(): void {
        require_once app_path('Helpers/Slug.php');
    }

    public function boot(): void {
        
    }
}
