<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\user_type_permission;

class UerTypePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [1 => [1, 2, 3, 4, 5, 6, 7, 8, 9 , 10 , 11 , 12]];

        foreach ($permissions as $user_type_id => $permission_ids) {
            foreach ($permission_ids as $permission_id) {
                user_type_permission::create([
                    'user_type_id' => $user_type_id,
                    'permission_id' => $permission_id,
                ]);
            }
        }
    }
}
