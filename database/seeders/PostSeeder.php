<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use App\Models\Tag;
use App\Models\User;
use App\Models\Post;

class PostSeeder extends Seeder {
    public function run(): void {
        Tag::truncate(); // wipe all tags
        Post::truncate();
        
        $tags = Tag::factory()->count(7)->create()->toArray();

        foreach (User::all() as $user) {
            $posts = Post::factory()->count(4)->create([
                'author_id' => $user->id,
            ]);

            foreach ($posts as $post) {
                $post->tags()->attach(Arr::random($tags)['id']);
            }
        }
    }
}