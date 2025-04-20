<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'image' => "https://picsum.photos/32/32?random=" . $this->faker->numberBetween(1, 100),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }
    protected function generateFakeImage(): string
    {
        // اسم الصورة
        $imageName = 'user-' . time() . '.jpg'; // اسم فريد للصورة

        // المسار حيث سيتم تخزين الصورة
        $storagePath = storage_path('app/public/images'); // تخزين الصور في مجلد داخل storage

        // تأكد من وجود المجلد
        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0777, true);
        }

        // إنشاء الصورة باستخدام Faker
        $imagePath = $this->faker->image($storagePath, 640, 480, null, false);

        // إعادة المسار النسبي للصورة (بدون الجزء الكامل)
        return 'images/' . basename($imagePath);
    }
    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}