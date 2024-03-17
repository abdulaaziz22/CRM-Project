<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create(['name'=>'حاسوب','college_id'=>'1']);
        Department::create(['name'=>'بترول','college_id'=>'1']);
        Department::create(['name'=>'صيدلة','college_id'=>'2']);
        Department::create(['name'=>'طب بشري','college_id'=>'2']);
        Department::create(['name'=>'كمياء','college_id'=>'1']);
    }
}
