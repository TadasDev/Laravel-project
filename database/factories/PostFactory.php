<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
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
            'user_id' => User::inRandomOrder()->value('id'),
            'category_id' => Category::inRandomOrder()->value('id'),
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => 10.8,
            'status' => $this->faker->randomElement(User::STATUSES),
            'label' => $this->faker->randomElement(['new', 'top']),
            'expires_at' => $this->faker->dateTimeBetween(now(), now()->addDays(60)),
            'show_phone_number' => $this->faker->boolean,
        ];
    }
}
