<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Profile;
use Faker\Factory as FakerFactory;

$faker = FakerFactory::create('en_US');


class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'dob' => $this->faker->date,
            'phone' => $this->faker->phoneNumber,
            'country' => $this->faker->country,
            'password' => bcrypt('12345678'), 
            'brief' => $this->faker->sentence,
            'job_title' => $this->faker->jobTitle,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
