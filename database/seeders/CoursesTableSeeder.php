<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Course::create([
                'course_name' => fake()->colorName,
                'description' => fake()->description,
                'start_date' => now(),
                'end_date' => now()->addDays(30),
                'teacher_id' => User::where('role', 'teacher')->inRandomOrder()->first()->id,

            ]);
        }
    }
}
