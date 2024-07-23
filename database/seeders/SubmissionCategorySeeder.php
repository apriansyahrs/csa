<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\SubmissionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubmissionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'ASSET/NONASSET', 'division' => 'HCM'],
            ['name' => 'ATK', 'division' => 'HCM'],
            ['name' => 'NOTA', 'division' => 'HCM'],
        ];

        foreach ($categories as $category) {
            $division = Division::where('name', $category['division'])->first();
            SubmissionCategory::create([
                'name' => $category['name'],
                'division_id' => $division->id,
            ]);
        }
    }
}
