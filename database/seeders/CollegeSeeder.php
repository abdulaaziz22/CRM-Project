<?php

namespace Database\Seeders;

use App\Models\College;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        College::create(['name'=>'الهندسة والبترول']);
        College::create(['name'=>'الطب']);
        College::create(['name'=>'البنات']);
    }
}
