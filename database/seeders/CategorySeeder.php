<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::create([
                'name' => 'technology',
                'created_at' => now(),
                'updated_at' => now(),
        ]);
        Category::create([
                'name' => 'health',
                'created_at' => now(),
                'updated_at' => now(),
        ]);
        Category::create([
                'name' => 'sports',
                'created_at' => now(),
                'updated_at' => now(),
        ]);

    }
}