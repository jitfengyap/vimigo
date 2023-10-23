<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Courses;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Courses>
 */
class CoursesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['O', 'C']);

        return [
            'student_id' => Student::factory(),
            'name' => $this->faker->name(),
            'status'=> $status,
            'start_date'=> $this->faker->dateTimeThisDecade(),
            'end_date' => $status == 'C'? $this->faker->dateTimeThisDecade(): NULL
        ];
    }
}
