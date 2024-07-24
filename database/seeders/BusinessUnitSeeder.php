<?php

namespace Database\Seeders;

use App\Models\BusinessUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['code' => 'TOP', 'name' => 'CV Top Selular', 'color' => null],
            ['code' => 'CS', 'name' => 'CV Complete Selular', 'color' => null],
            ['code' => 'MAJU', 'name' => 'CV Maju Tecnologi', 'color' => null],
            ['code' => 'MKLI', 'name' => 'PT. Maju Kendaraan Listrik Indonesia', 'color' => null],
            ['code' => 'MSI', 'name' => 'PT Media Selular Indonesia', 'color' => null],
            ['code' => 'RISM', 'name' => 'PT. Retail Indonesia Selalu Maju', 'color' => null],
            ['code' => 'IMS', 'name' => 'CV Inspirasi Mulia Sejahtera', 'color' => null],
            ['code' => 'AMAZY', 'name' => 'Amazy', 'color' => null],
            ['code' => 'TKANAN', 'name' => 'Toko Mas An An', 'color' => null],
            ['code' => 'MOMOYO', 'name' => 'Momoyo', 'color' => null],
            ['code' => 'BMS', 'name' => 'CV Berkarya Maju Sejahtera', 'color' => null],

            ['code' => '-', 'name' => '-', 'color' => null],
            ['code' => 'CMULIA', 'name' => 'CMULIA', 'color' => null],
            ['code' => 'COMPLETEME', 'name' => 'COMPLETEME', 'color' => null],
        ];

        foreach ($units as $unit) {
            BusinessUnit::create($unit);
        }
    }
}
