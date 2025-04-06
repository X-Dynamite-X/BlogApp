<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(10),
            // 'image' => 'posts/' . $this->faker->image('public/storage/posts', 640, 480, null, false),
            'user_id' => 1,
            'category_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}