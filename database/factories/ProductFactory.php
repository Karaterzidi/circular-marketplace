<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $price = 20.99;
        return [
            'user_id' => 2,
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->realText($this->faker->numberBetween(10,20)),
            'price' => $price
        ];
    }
}
