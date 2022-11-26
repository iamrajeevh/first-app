<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NewUser>
 */
class NewUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_name'=>fake()->name(),
            'user_age'=>rand(19,58),
            'user_mobile'=>rand(6000000000,9999999999),
            'status'=>rand(0,1),
        ];
    }
}
