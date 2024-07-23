<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'ALAT POTONG KERTAS UK F4',
                'item_category_id' => 2,
                'item_unit_type_id' => 1,
                'price' => 214000,
                'description' => NULL,
                'image' => NULL,
                'stock' => NULL,
                'created_at' => '2023-04-03 04:15:41',
                'updated_at' => '2023-09-26 07:53:24',
            ],
            [
                'name' => 'AMPLOP COKLAT TANPA TALI',
                'item_category_id' => 2,
                'item_unit_type_id' => 2,
                'price' => 35000,
                'description' => NULL,
                'image' => NULL,
                'stock' => NULL,
                'created_at' => '2023-04-03 04:15:41',
                'updated_at' => '2023-04-03 04:15:41',
            ],
            [
                'name' => 'AMPLOP PUTIH BESAR',
                'item_category_id' => 2,
                'item_unit_type_id' => 2,
                'price' => 20000,
                'description' => NULL,
                'image' => NULL,
                'stock' => NULL,
                'created_at' => '2023-04-03 04:15:41',
                'updated_at' => '2023-04-03 04:15:41',
            ],
            [
                'name' => 'AMPLOP PUTIH KECIL',
                'item_category_id' => 2,
                'item_unit_type_id' => 2,
                'price' => 15000,
                'description' => '-',
                'image' => NULL,
                'stock' => 0,
                'created_at' => '2023-04-03 04:15:41',
                'updated_at' => '2023-09-23 03:57:37',
            ],
            [
                'name' => 'ORDNER A4/F4',
                'item_category_id' => 2,
                'item_unit_type_id' => 1,
                'price' => 20000,
                'description' => NULL,
                'image' => NULL,
                'stock' => NULL,
                'created_at' => '2023-04-03 04:15:41',
                'updated_at' => '2023-09-23 03:59:08',
            ],
            [
                'name' => 'ORDNER FILE A5',
                'item_category_id' => 2,
                'item_unit_type_id' => 1,
                'price' => 20000,
                'description' => NULL,
                'image' => NULL,
                'stock' => NULL,
                'created_at' => '2023-04-03 04:15:41',
                'updated_at' => '2023-09-23 03:58:55',
            ],
            [
                'name' => 'BATTERAI A2',
                'item_category_id' => 2,
                'item_unit_type_id' => 1,
                'price' => 6500,
                'description' => '-',
                'image' => NULL,
                'stock' => 0,
                'created_at' => '2023-04-03 04:15:41',
                'updated_at' => '2024-05-07 02:08:26',
            ],
            [
                'name' => 'BATTERAI A3',
                'item_category_id' => 2,
                'item_unit_type_id' => 1,
                'price' => 6500,
                'description' => '-',
                'image' => NULL,
                'stock' => 0,
                'created_at' => '2023-04-03 04:15:41',
                'updated_at' => '2024-05-07 02:08:38',
            ],
            [
                'name' => 'BATTERAI ABC A4',
                'item_category_id' => 2,
                'item_unit_type_id' => 1,
                'price' => 6000,
                'description' => NULL,
                'image' => NULL,
                'stock' => NULL,
                'created_at' => '2023-04-03 04:15:41',
                'updated_at' => '2023-04-03 04:15:41',
            ],
            [
                'name' => 'BINDER CLIP 107',
                'item_category_id' => 2,
                'item_unit_type_id' => 2,
                'price' => 5000,
                'description' => NULL,
                'image' => NULL,
                'stock' => NULL,
                'created_at' => '2023-04-03 04:15:41',
                'updated_at' => '2023-09-23 04:12:49',
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
