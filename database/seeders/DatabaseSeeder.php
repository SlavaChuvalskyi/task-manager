<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $user = User::factory()->create([
            'name' => 'Jon Doe'
        ]);

        User::factory(10)->create();

        Project::factory(5)->create(['user_id' => $user->id]);
        Task::factory(10)->create(['project_id' => Project::query()->first()->getKey()]);
    }
}
