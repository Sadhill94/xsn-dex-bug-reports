<?php
namespace Database\Factories;

use App\Models\File;
use App\Models\Issue;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;
    protected $extensions = ['jpg', 'png', 'log', 'txt'];


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'display_name' => $this->faker->word,
            'extension' => $this->extensions[rand(0, 3)],
            'size' => rand(400, 2000),
            'issue_id' => Issue::inRandomOrder()->first(),
        ];
    }

    public function createPlaceholders()
    {
        return $this->state(function (array $attributes) {
            $file = $this->faker->image('public/storage/uploads/tests');
            return [
                'name' => time().'_'.$this->faker->word,
                'file_path' => str_replace('public','' ,$file)
            ];
        });
    }

    public function mockFiles()
    {
        return $this->state(function (array $attributes) {
            $filePath = $this->faker->file(storage_path().'/app/public/uploads/tests', public_path().'/storage/uploads/tests/', false);
            return [
                'name' => time().'_'.$this->faker->word,
                'file_path' => '/storage/uploads/tests/'.$filePath
            ];
        });
    }
}

