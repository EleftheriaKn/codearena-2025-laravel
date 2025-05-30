<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        User::factory(10)->create()->each(function ($user) {
            $user->posts()->saveMany(Post::factory(rand(1, 5))->make()-> each(function ($post){
                $post->published_at = now();
                $post->promoted = fake()->boolean();
            }));
        });
    }
}