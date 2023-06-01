<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;



class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {$faker = FakerFactory::create('en_US');

        return [
            'body' => Str::limit($faker->paragraph, 100),
            'user_id' => User::factory()->create()->id,
            'post_id' => Post::factory()->create()->id,
        ];
    }
}
