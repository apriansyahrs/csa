<?php

namespace Database\Seeders;

use App\Models\ItemUnitType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemUnitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unitTypes = [
            'BUKU',
            'DUS',
            'PACK',
            'PCS',
            'RIM',
            'ROLL',
            'SET',
            'SET',
            'TUBE',
            'UNIT',
        ];

        foreach ($unitTypes as $unitType) {
            ItemUnitType::create(['name' => $unitType]);
        }
    }
}
