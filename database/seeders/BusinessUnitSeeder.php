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
            ['code' => 'CTS', 'name' => 'CV Top Selular', 'color' => null],
            ['code' => 'CCS', 'name' => 'CV Complete Selular', 'color' => null],
            ['code' => 'CMT', 'name' => 'CV MAJU TECNOLOGI', 'color' => null],
            ['code' => 'PMK', 'name' => 'PT. MAJU KENDARAAN LISTRIK INDONESIA', 'color' => null],
            ['code' => 'PMS', 'name' => 'PT Media Selular Indonesia', 'color' => null],
            ['code' => 'PRI', 'name' => 'PT. RETAIL INDONESIA SELALU MAJU', 'color' => null],
            ['code' => 'CIM', 'name' => 'CV Inspirasi Mulia Sejahtera', 'color' => null],
            ['code' => 'A', 'name' => 'Amazy', 'color' => null],
            ['code' => 'TMA', 'name' => 'Toko Mas An An', 'color' => null],
            ['code' => 'M', 'name' => 'MOMOYO', 'color' => null],
            ['code' => 'CBM', 'name' => 'CV Berkarya Maju Sejahtera', 'color' => null],
            ['code' => 'CC', 'name' => 'CV Celine', 'color' => null],
        ];

        foreach ($units as $unit) {
            BusinessUnit::create($unit);
        }
    }
}
