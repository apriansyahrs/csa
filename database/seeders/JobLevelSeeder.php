<?php

namespace Database\Seeders;

use App\Models\JobLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            ['name' => 'STAFF'],
            ['name' => 'TEAM LEADER'],
            ['name' => 'COORDINATOR'],
            ['name' => 'CHIEF'],
            ['name' => 'MANAGER'],
            ['name' => 'BOD'],
        ];

        foreach ($levels as $level) {
            JobLevel::create($level);
        }
    }
}
