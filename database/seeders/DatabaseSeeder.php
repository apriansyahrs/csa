<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Super Admin',
            'username' => 'admin',
            'email' => 'admin@dev.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('password'),
        ]);

        Artisan::call('shield:super-admin', ['--user' => 1]);
        Artisan::call('shield:generate --all');

        $this->call([
            // managament master
            BusinessUnitSeeder::class,
            AreaSeeder::class,
            DivisionSeeder::class,
            JobPositionSeeder::class,
            JobLevelSeeder::class,

            // submission master
            ItemUnitTypeSeeder::class,
            ItemCategorySeeder::class,
            SubmissionCategorySeeder::class,
            ItemSeeder::class,
        ]);
    }
}
