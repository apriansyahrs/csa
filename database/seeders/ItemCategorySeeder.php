<?php

namespace Database\Seeders;

use App\Models\ItemCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'ASSET/NONASSET',
            'ATK',
            'NOTA',
        ];

        foreach ($categories as $category) {
            ItemCategory::create(['name' => $category]);
        }

    }
}
