<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 建立五個用戶，每個用戶有十個任務
        User::factory(5)->has(
            // 建立十個任務
            Task::factory(10)
        )->create();
    }
}
