<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create_request' => 'انشاء طلب',
            'create_user' => 'انشاء مستخدم',
            'create_tracking' => 'انشاء تتبع',
            'delete_request' => 'حدف طلب',
            'delete_tracking' => 'حدف تتبع',
            'update_user' => 'تعديل مستخدم',
            'update_tracking' => 'تعديل تتبع',
            'update_request' => 'تعديل طلب',
            'show_request' => 'عرض طلب',
            'show_user' => 'عرض مستخدم',
        ];
        foreach ($permissions as $name => $display_name) {
            Permission::create(['name' => $name, 'display_name' => $display_name]);
        }
           
    }
}
