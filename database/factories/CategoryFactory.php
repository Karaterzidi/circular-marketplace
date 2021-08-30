<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    
    public function definition()
    {
        static $position = 1;

        return [
            'title' => $this->faker->text(20),
            'position' => $position++
        ];
    }
}
