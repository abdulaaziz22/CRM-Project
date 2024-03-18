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
        $Colleges=['الهندسة والبترول','الطب','البنات','القانون','التعليم المفتوح','العلوم الادارية'];
        foreach($Colleges as $College){
            College::create(['name'=>$College]);
        }
    }
}
