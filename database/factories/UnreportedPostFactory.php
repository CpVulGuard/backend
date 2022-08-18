<?php

namespace Database\Factories;

use App\Models\UnreportedPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnreportedPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UnreportedPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'soPostId' => $this->faker->numberBetween($int1=1000000),
        ];
    }
}
