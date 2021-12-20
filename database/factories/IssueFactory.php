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
            'version' => '4.3.2',
            'steps_to_reproduce' => $this->faker->text(rand(80,120)),
            'user_discord_id' => $this->faker->userName,
            'extra_infos' => $this->faker->text(rand(30, 90)),
            'status_id' => Status::inRandomOrder()->first(),
            'category_id' => Category::inRandomOrder()->first()
        ];
    }
}

