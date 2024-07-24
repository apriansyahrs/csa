<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar path ke file SQL
        $sqlFiles = [
            'sql/items.sql',
            'sql/submissions.sql',
            'sql/submission_details.sql',
            'sql/submission_approvals.sql'
        ];

        // Eksekusi setiap file SQL
        foreach ($sqlFiles as $file) {
            $path = database_path($file);
            if (File::exists($path)) {
                $sql = File::get($path);

                try {
                    DB::unprepared($sql);
                } catch (\Exception $e) {
                    // Log error
                    \Log::error("Error executing SQL file {$path}: " . $e->getMessage());
                    $this->command->error("Error executing SQL file {$path}: " . $e->getMessage());
                }
            } else {
                $this->command->error("File not found: {$path}");
            }
        }
    }
}
