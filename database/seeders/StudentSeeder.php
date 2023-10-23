<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::factory()
            ->count(25)
            ->hasCourses(10)
            ->create();

        Student::factory()
            ->count(100)
            ->hasCourses(5)
            ->create();

        Student::factory()
            ->count(100)
            ->hasCourses(3)
            ->create();

        Student::factory()
            ->count(5)
            ->create();
    }
}
