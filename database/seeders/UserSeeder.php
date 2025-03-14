<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;

class UserSeeder extends Seeder {
    public function run(): void {
        $fred = User::updateOrCreate([
            'name' => 'fred',
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
        ]);
        $fred->roles()->attach(Role::firstWhere('name', 'author'));
    }
}
