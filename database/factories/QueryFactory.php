<?php

namespace Database\Factories;

use App\Models\StackoverflowQuery;
use Illuminate\Database\Eloquent\Factories\Factory;

class QueryFactory extends Factory
{
    protected $model = StackoverflowQuery::class;

    public function definition(): array
    {
        return [
            'sqlQuery' => $this->faker->realText(),
            'regex' => $this->faker->realText(),
            'reason' => $this->faker->realText(),
            'tags' => $this->faker->realText(),
            'creator' => $this->faker->numberBetween($int1=10),
            'active' => $this->faker->boolean
        ];
    }
}