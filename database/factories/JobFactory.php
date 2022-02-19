<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $minBasic = $this->faker->randomFloat(2, 1200, 229000);
        $maxBasic = $this->faker->randomFloat(2, $minBasic, 229000);

        return [
            'department_id' => Department::get()->random()->id,
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(3),
            'minimum_basic' => $minBasic,
            'maximum_basic' => $maxBasic
        ];
    }
}
