<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->count(30)->create();

        Topic::create(['slug' => 'sports', 'name' => 'Sports']);
        Topic::create(['slug' => 'business', 'name' => 'Business']);
        Topic::create(['slug' => 'health', 'name' => 'Health']);
        Topic::create(['slug' => 'tech', 'name' => 'Tech']);

        Post::factory()->count(60)->create();
    }
}
