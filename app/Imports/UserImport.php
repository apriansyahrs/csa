<?php

namespace App\Imports;

use App\Models\BusinessUnit;
use App\Models\Division;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Permission\Models\Role;

class UserImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            // Cari atau buat Business Unit
            $businessUnit = BusinessUnit::firstOrCreate(['code' => $row['badan_usaha']]);

            // Cari atau buat Division
            $division = Division::firstOrCreate(['name' => $row['divisi']]);
            $area = $division->area_id;

            // Cari user approval berdasarkan username
            $approval = User::where('username', $row['approval'])->first();

            // Cari atau buat user
            $user = User::updateOrCreate(
                ['id' => $row['id']],
                [
                    'username' => $row['username'],
                    'name' => $row['fullname'],
                    'business_unit_id' => $businessUnit->id,
                    'area_id' => $area,
                    'division_id' => $division->id,
                    'approval_id' => $approval ? $approval->id : null,
                    'password' => bcrypt($row['password']),
                ]
            );

            // Sinkronisasi peran dari kolom role
            if (!empty($row['role'])) {
                $roleName = strtolower($row['role']); // Konversi ke huruf kecil
                $role = Role::firstOrCreate(['name' => $roleName]);
                $user->syncRoles($role);
            }
        }
    }
}
