<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'dynamite',
            'email' => 'dynamite@gmail.com',
            'password' => bcrypt('123'),
        ]);
        User::factory(count: 10)->create();
        $this->call([
            CategorySeeder::class,
         ]);
        Post::factory(count: 800)->create();
    }
}