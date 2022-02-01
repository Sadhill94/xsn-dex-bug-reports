<?php
namespace Database\Factories;

use App\Models\Category;
use App\Models\Issue;
use App\Models\Status;
use App\Models\Type;
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
            'title' => $this->faker->text(rand(25,70)),
            'description' => $this->faker->text(rand(90, 90)),
            'os' => $this->osVersions[rand(0, 2)],
            'version' => '0.4.4.0',
            'steps_to_reproduce' => $this->faker->text(rand(120,240)),
            'user_discord_id' => $this->faker->userName,
            'trello_ref' => rand(1, 4) == 3 ? rand(12,985) : null,
            'status_id' => Status::inRandomOrder()->first(),
            'category_id' => Category::inRandomOrder()->first(),
            'type_id' => Type::inRandomOrder()->first(),
            'created_at' => $this->faker->dateTimeThisMonth()
        ];
    }
}

