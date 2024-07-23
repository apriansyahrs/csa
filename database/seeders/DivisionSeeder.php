<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            ['name' => '-', 'area' => '-'],
            ['name' => '4S-CILEDUG', 'area' => 'MKLI-4S'],
            ['name' => '4S-CISOKA', 'area' => 'MKLI-4S'],
            ['name' => '4S-INDRAMAYU', 'area' => 'MKLI-4S'],
            ['name' => '4S-JATIWANGI', 'area' => 'MKLI-4S'],
            ['name' => '4S-KUDUS', 'area' => 'MKLI-4S'],
            ['name' => '4S-MAJALAYA', 'area' => 'MKLI-4S'],
            ['name' => '4S-PAMANUKAN', 'area' => 'MKLI-4S'],
            ['name' => '4S-PASIRKOJA', 'area' => 'MKLI-4S'],
            ['name' => '4S-PEKALONGAN', 'area' => 'MKLI-4S'],
            ['name' => '4S-PETRATEAN', 'area' => 'MKLI-4S'],
            ['name' => '4S-PURWADADI', 'area' => 'MKLI-4S'],
            ['name' => '4S-RENGAS', 'area' => 'MKLI-4S'],
            ['name' => '4S-SINDANG', 'area' => 'MKLI-4S'],
            ['name' => '4S-TELAGASARI', 'area' => 'MKLI-4S'],
            ['name' => '4S-TIGARAKSA', 'area' => 'MKLI-4S'],
            ['name' => 'AMAZY', 'area' => 'AMAZY'],
            ['name' => 'AUDIT', 'area' => 'HO'],
            ['name' => 'BUSDEV', 'area' => 'HO'],
            ['name' => 'CMULIA', 'area' => 'CMULIA'],
            ['name' => 'COMPLETEME', 'area' => 'COMPLETEME'],
            ['name' => 'CS-BABAKAN', 'area' => 'TOKO'],
            ['name' => 'CS-CILACAP', 'area' => 'TOKO'],
            ['name' => 'CS-CILEDUG', 'area' => 'TOKO'],
            ['name' => 'CS-GEBANG', 'area' => 'TOKO'],
            ['name' => 'CS-JATIWANGI1', 'area' => 'TOKO'],
            ['name' => 'CS-JATIWANGI2', 'area' => 'TOKO'],
            ['name' => 'CS-KROYA', 'area' => 'MITRA'],
            ['name' => 'CS-PABUARAN2', 'area' => 'TOKO'],
            ['name' => 'CS-PATROL', 'area' => 'TOKO'],
            ['name' => 'CS-PERUM', 'area' => 'TOKO'],
            ['name' => 'CS-PETRATEAN', 'area' => 'TOKO'],
            ['name' => 'CS-SINDANG', 'area' => 'TOKO'],
            ['name' => 'CS-SUBANG', 'area' => 'TOKO'],
            ['name' => 'CS-SURYA', 'area' => 'TOKO'],
            ['name' => 'CS-TEGAL', 'area' => 'TOKO'],
            ['name' => 'CS-TUPAREV', 'area' => 'TOKO'],
            ['name' => 'CV MAJU HO JAKARTA', 'area' => 'CV MAJU TECNOLOGI'],
            ['name' => 'DEPO-ACC', 'area' => 'TOP'],
            ['name' => 'DEPO-BANDUNG', 'area' => 'TOP'],
            ['name' => 'DEPO-CRB-HO', 'area' => 'TOP'],
            ['name' => 'DEPO-JAKARTA', 'area' => 'TOP'],
            ['name' => 'DEPO-JOGJA', 'area' => 'TOP'],
            ['name' => 'DEPO-LOGISTIK', 'area' => 'TOP'],
            ['name' => 'DEPO-PWK', 'area' => 'TOP'],
            ['name' => 'DEPO-PWT', 'area' => 'TOP'],
            ['name' => 'DEPO-SEMARANG', 'area' => 'TOP'],
            ['name' => 'DEPO-TEGAL', 'area' => 'TOP'],
            ['name' => 'FINANCE', 'area' => 'HO'],
            ['name' => 'FINANCE-AR', 'area' => 'HO'],
            ['name' => 'FINANCE-PAJAK', 'area' => 'HO'],
            ['name' => 'GCRB-HP', 'area' => 'TOP'],
            ['name' => 'GCRB-RETUR', 'area' => 'TOP'],
            ['name' => 'GHM', 'area' => 'TOKO'],
            ['name' => 'GS-JATIBARANG', 'area' => 'MITRA'],
            ['name' => 'GS-KALIJATI', 'area' => 'MITRA'],
            ['name' => 'GUDANG ACEH', 'area' => 'CV MAJU TECNOLOGI'],
            ['name' => 'GUDANG BENGKULU', 'area' => 'CV MAJU TECNOLOGI'],
            ['name' => 'GUDANG JAMBI', 'area' => 'CV MAJU TECNOLOGI'],
            ['name' => 'GUDANG LAMPUNG', 'area' => 'CV MAJU TECNOLOGI'],
            ['name' => 'GUDANG MEDAN', 'area' => 'CV MAJU TECNOLOGI'],
            ['name' => 'GUDANG PADANG', 'area' => 'CV MAJU TECNOLOGI'],
            ['name' => 'GUDANG PALEMBANG', 'area' => 'CV MAJU TECNOLOGI'],
            ['name' => 'GUDANG PEKANBARU', 'area' => 'CV MAJU TECNOLOGI'],
            ['name' => 'GUDANG PIK', 'area' => 'CV MAJU TECNOLOGI'],
            ['name' => 'HCM', 'area' => 'HO'],
            ['name' => 'HO', 'area' => 'HO'],
            ['name' => 'HPMART-SINDANG', 'area' => 'TOKO'],
            ['name' => 'i-STORE', 'area' => 'MITRA'],
            ['name' => 'IMMANUEL', 'area' => 'MITRA'],
            ['name' => 'INTIPHONSEL', 'area' => 'MITRA'],
            ['name' => 'MARCOMM', 'area' => 'HO'],
            ['name' => 'MIS-DATA', 'area' => 'HO'],
            ['name' => 'MIS-IT', 'area' => 'HO'],
            ['name' => 'MISHOP-CILEDUG', 'area' => 'TOKO'],
            ['name' => 'MKLI-BANDUNG', 'area' => 'MKLI-DEPO'],
            ['name' => 'MKLI-CIREBON', 'area' => 'MKLI-DEPO'],
            ['name' => 'MKLI-DADAP', 'area' => 'MKLI-DEPO'],
            ['name' => 'MKLI-HO', 'area' => 'MKLI-HO'],
            ['name' => 'MKLI-JOGJA', 'area' => 'MKLI-DEPO'],
            ['name' => 'MKLI-KARAWANG', 'area' => 'MKLI-DEPO'],
            ['name' => 'MKLI-MAKASSAR', 'area' => 'MKLI-DEPO'],
            ['name' => 'MKLI-MANADO', 'area' => 'MKLI-DEPO'],
            ['name' => 'MKLI-PEKANBARU', 'area' => 'MKLI-DEPO'],
            ['name' => 'MKLI-PURWAKARTA', 'area' => 'MKLI-DEPO'],
            ['name' => 'MKLI-PURWOKERTO', 'area' => 'MKLI-DEPO'],
            ['name' => 'MKLI-TANGERANG', 'area' => 'MKLI-DEPO'],
            ['name' => 'MOMOYO', 'area' => 'MOMOYO'],
            ['name' => 'ONLINE', 'area' => 'HO'],
            ['name' => 'OS-TP', 'area' => 'TOKO'],
            ['name' => 'PLAZACELL', 'area' => 'MITRA'],
            ['name' => 'RETAIL', 'area' => 'HO'],
            ['name' => 'RISM', 'area' => 'RISM'],
            ['name' => 'SCM-PURCHASE', 'area' => 'HO'],
            ['name' => 'SP-JATIBARANG', 'area' => 'MITRA'],
            ['name' => 'SUMBERKOMSEL', 'area' => 'MITRA'],
            ['name' => 'TELEMARKETING', 'area' => 'HO'],
            ['name' => 'TKANAN', 'area' => 'TKANAN'],
            ['name' => 'TRANSSION-STORE', 'area' => 'TOKO'],
            ['name' => 'WHM', 'area' => 'HO'],
        ];

        foreach ($divisions as $division) {
            $area = Area::where('name', $division['area'])->first();
            Division::create([
                'name' => $division['name'],
                'area_id' => $area->id,
            ]);
        }
    }
}
