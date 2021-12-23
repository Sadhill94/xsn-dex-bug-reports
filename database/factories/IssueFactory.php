<?php
namespace Database\Factories;

use App\Models\Category;
use App\Models\Issue;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class IssueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Issue::class;
    protected $osVersions = ['Windows', 'MacOs', 'Linux'];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->text(rand(25,70)),
            'os' => $this->osVersions[rand(0, 2)],
            'version' => '0.4.4.0',
            'steps_to_reproduce' => $this->faker->text(rand(120,240)),
            'user_discord_id' => $this->faker->userName,
            'github_link' => rand(1, 4) == 3 ? $this->faker->url : null,
            'extra_infos' => $this->faker->text(rand(50, 90)),
            'status_id' => Status::inRandomOrder()->first(),
            'category_id' => Category::inRandomOrder()->first(),
            'created_at' => $this->faker->dateTimeThisMonth()
        ];
    }
}

