<?php

namespace Database\Factories;

use App\Enums\TaskStatus;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->company() . ' - ' . fake()->text(10),
            'description' => fake()->text(30),
            'user_id' => User::factory(),
        ];
    }

    public function withTask(int $count = 1, ?TaskStatus $status = null) : self
    {
        return $this->afterCreating(function (Project $project) use ($status, $count) {
            $randomStatus = $status ?? TaskStatus::cases()[array_rand(TaskStatus::cases())];
            Task::factory()->count($count)->create(['project_id' => $project->getKey(), 'status' => $randomStatus]);
        });
    }

}
