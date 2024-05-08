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
        user_type_permission::create([
            'user_type_id'=>1,
            'permission_id'=>9,
        ]);
    }
}
