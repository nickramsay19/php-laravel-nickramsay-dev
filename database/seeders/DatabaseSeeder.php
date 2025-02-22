<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $nick = User::factory()
            ->hasPosts(3)
            ->create(['name' => 'nick']);

        $posts = $nick->posts;

        $tags = Tag::factory()->count(5)->create()->toArray();
        foreach ($posts as $post) {
            $post->tags()->attach(Arr::random($tags)['id']);
        }
    }
}
