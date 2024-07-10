<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Categoryblog;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'categoryblog_id' => categoryblog::factory(),
            'user_id' => User::factory(),
            'title' => fake()->sentence(3),
            'slug' => Str::slug(fake()->sentence(3)),
            'body' => fake()->text(),
        ];
    }
}
