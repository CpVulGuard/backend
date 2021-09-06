<?php

namespace Database\Factories;

use App\Models\UserRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['add', 'delete']),
            'reason' => $this->faker->realText(),
            'soPostId' => $this->faker->numberBetween($int1=1000000),
            'codeBlockIndex' => $this->faker->numberBetween(0,10),
            'rows' => $this->faker->randomElement(['1,4', '1', '1-10'])
        ];
    }
}
