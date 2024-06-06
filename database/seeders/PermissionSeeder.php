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
            'delete_request' => 'حذف طلب',
            'delete_tracking' => 'حذف تتبع',
            'delete_user' => 'حذف مستخدم',
            'update_user' => 'تعديل مستخدم',
            'update_tracking' => 'تعديل تتبع',
            'update_request' => 'تعديل طلب',
            'show_request' => 'عرض طلب',
            'show_users' => 'عرض مستخدم',
            'show_tracking' => 'عرض تتبع',
            'create_UserType' => 'انشاء نوع الحساب',
            'show_UserType' => 'عرض نوع الحساب',
            'delete_UserType' => 'حذف نوع الحساب',
            'update_UserType' => 'تعديل نوع الحساب',
            'create_Building' => 'انشاء المبنى',
            'delete_Building' => 'حذف المبنى',
            'show_Building' => 'عرض المباني',
            'update_Building' => 'تعديل المباني',
            'show_Category' => 'عرض الانواع',
            'update_Category' => 'تعديل الانواع',
            'create_Category' => 'انشاء نوع',
            'delete_Category' => 'حذف نوع',
            'create_College' => 'انشاء كلية',
            'delete_College' => 'حذف كلية',
            'show_College' => 'عرض الكليات',
            'update_College' => 'تعديل الكليات',
            'show_Room' => 'عرض الغرف',
            'create_Room' => 'انشاء غرفة',
            'delete_Room' => 'حذف غرفة ',
            'update_Room' => 'تعديل غرفة ',
            'delete_RoomType' => 'حذف نوع الغرفة',
            'create_RoomType' => 'انشاء نوع الغرفة',
            'show_RoomType' => 'عرض انواع الغرف',
            'update_RoomType' => 'تعديل نوع الغرفة',
        ];
        foreach ($permissions as $name => $display_name) {
            Permission::create(['name' => $name, 'display_name' => $display_name]);
        }
           
    }
}
