<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'author_id'=>$this->faker->randomElement(User::pluck('id')),
            'category_id'=>$this->faker->randomElement(Category::pluck('id')),
            'title' => $this->faker->sentence(),
            'image' => $this->faker->image(),
            'body' => $this->faker->text(),
        ];
    }
}
