<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reason' => $this->faker->realText(),
            'soPostId' => $this->faker->numberBetween($int1=1000000),
            'imported' => $this->faker->boolean(),
            'codeBlockIndex' => $this->faker->numberBetween(-1, 10),
            'rows' => $this->faker->randomElement(['1,4', '1', '1-10'])
        ];
    }
}
