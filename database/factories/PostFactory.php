<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'slug' => function (array $attributes) {
                return slug($attributes['title']);
            },
            'title' => fake()->catchPhrase(),
            'body' => fake()->paragraphs(2, true),
            'published_at' => Carbon::now(),
        ];
    }
}
