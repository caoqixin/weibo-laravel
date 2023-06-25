<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{

    protected $model = Article::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date_time = $this->faker->date . ' ' . $this->faker->time;
        return [
            'user_id'    => $this->faker->randomElement(User::all()->pluck('id')->all()),
            'user_id'    => $this->faker->randomElement(User::all()->pluck('id')->all()),
            'content'    => $this->faker->text(),
            'created_at' => $date_time,
            'updated_at' => $date_time,
        ];
    }
}
