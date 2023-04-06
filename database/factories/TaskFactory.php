<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'task_name' => $this->faker->name(),
            'user_id' => rand(DB::table('users')->min('id'), DB::table('users')->max('id')),
            'section_id' => rand(DB::table('sections')->min('id'), DB::table('sections')->max('id')),
            'task_status' => true
        ];
    }
}
