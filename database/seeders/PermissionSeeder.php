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
            'delete_user' => 'حدف مستخدم',
            'update_user' => 'تعديل مستخدم',
            'update_tracking' => 'تعديل تتبع',
            'update_request' => 'تعديل طلب',
            'show_request' => 'عرض طلب',
            'show_users' => 'عرض مستخدم',
            'show_tracking' => 'عرض تتبع',
            'create_UserType' => 'انشاء نوع الحساب',
            'show_UserType' => 'عرض نوع الحساب',
            'delete_UserType' => 'حدف نوع الحساب',
            'update_UserType' => 'تعديل نوع الحساب',
            'create_Building' => 'انشاء المبنى',
            'delete_Building' => 'حدف المبنى',
            'show_Building' => 'عرض المباني',
            'show_Category' => 'عرض الانواع',
            'create_Category' => 'انشاء نوع',
            'delete_Category' => 'حدف نوع',
            'create_College' => 'انشاء كلية',
            'delete_College' => 'حدف كلية',
            'show_College' => 'عرض الكليات',
            'show_Room' => 'عرض الغرف',
            'create_Room' => 'انشاء غرفة',
            'delete_Room' => 'حدف غرفة ',
        ];
        foreach ($permissions as $name => $display_name) {
            Permission::create(['name' => $name, 'display_name' => $display_name]);
        }
           
    }
}
