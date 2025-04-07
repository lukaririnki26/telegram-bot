<?php

namespace Database\Factories;

use App\Models\Posts;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Posts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startPublish = $this->faker->dateTimeBetween('-1 year', '+1 year');
        $endPublish = $this->faker->optional()->dateTimeBetween($startPublish, '+1 year');

        return [
            'lang' => $this->faker->randomElement(['en', 'id', 'es', 'fr']),
            'title' => $title = $this->faker->sentence,
            'slug' => Str::slug($this->faker->unique()->sentence),
            'excerpt' => $excerpt = $this->faker->optional()->paragraph,
            'content' => $this->faker->optional()->paragraphs(3, true),
            'metadata' => $this->faker->optional()->passthrough([
                'metatitle' => $title,
                'metadescription' => $excerpt,
                'metakeywords' => $this->faker->words(5),
            ]),
            'settings' => $this->faker->optional()->passthrough([
                'page_layout' => $this->faker->randomElement(['full', 'sidebar']),
                'show_comments' => $this->faker->boolean,
            ]),
            'start_publish' => $startPublish,
            'end_publish' => $endPublish,
            'record_visibility' => $this->faker->randomElement(['PUBLIC', 'READONLY', 'PROTECTED', 'PRIVATE', 'MEMBER_ONLY']),
            'record_type' => $this->faker->randomElement(['POST', 'PAGE']),
            'record_left' => $this->faker->optional()->randomNumber(),
            'record_right' => $this->faker->optional()->randomNumber(),
            'parent_id' => $this->faker->optional()->randomNumber(),
            'record_status' => $this->faker->randomElement(['DELETED','ARCHIVED','DRAFT','UNPUBLISHED','PUBLISH','LOCK']),
            'created_by' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->randomNumber(),
        ];
    }
}
