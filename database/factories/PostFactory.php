<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
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
        $random = rand(0, 100);
        if ($random < 2) {
            return [
                'user_id' => User::factory()->create()->id,
                'category_id' => Category::factory()->create()->id,
                'title' => $this->faker->sentence,
                'slug' => $this->faker->slug,
                'excerpt' => '<p>' .implode('</p><p>',$this->faker->paragraphs(2)) . '</p>',
                'body' => '<p>' .implode('</p><p>',$this->faker->paragraphs(7)) . '</p>',
                'published_at' => now()->subDays(rand(3,290)),
            ];
        }
        else{
            return [
                'user_id' => User::all()->shuffle()->first()->id,
                'category_id' => Category::all()->shuffle()->first()->id,
                'title' => $this->faker->sentence,
                'slug' => $this->faker->slug,
                'excerpt' => '<p>' .implode('</p><p>',$this->faker->paragraphs(2)) . '</p>',
                'body' => '<p>' .implode('</p><p>',$this->faker->paragraphs(7)) . '</p>',
                'published_at' => now()->subDays(rand(3,290)),
            ];
        }

    }
}
