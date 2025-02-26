<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'), // Hash::make('password')
        ]);

        Category::create([
            'name' => 'Uncategorized',
            'slug' => 'uncategorized',
        ]);

        // Tag::create(['name' => 'Salary']);
        // Tag::create(['name' => 'Food']);
        // Tag::create(['name' => 'Entertaiment']);

        $this->call(TagSeeder::class);
    }
}
