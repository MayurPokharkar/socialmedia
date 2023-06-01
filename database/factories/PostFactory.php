<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;
use Faker\Factory as FakerFactory;




class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    
    {$faker = FakerFactory::create('en_US');

        return [
            'title' => $faker->sentence,
            'body' => $faker->paragraph,
            'user_id' => User::factory()->create()->id,
        ];
    }
}
