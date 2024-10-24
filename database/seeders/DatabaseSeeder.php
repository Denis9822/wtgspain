<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(3)
            ->has(Team::factory())
            ->create();
        Task::factory(3)->create();
        Comment::factory(3)->create();
    }
}
