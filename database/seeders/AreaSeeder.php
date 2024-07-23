<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas = [
            '-',
            'AMAZY',
            'CMULIA',
            'COMPLETEME',
            'CV MAJU TECNOLOGI',
            'HO',
            'MITRA',
            'MKLI-4S',
            'MKLI-DEPO',
            'MKLI-HO',
            'MOMOYO',
            'RISM',
            'TKANAN',
            'TOKO',
            'TOP',
        ];

        foreach ($areas as $area) {
            Area::create(['name' => $area]);
        }
    }
}
