<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $UserTypes = ['العميد' , 'دكتور' , 'امين الكلية' ];
        foreach($UserTypes as $UserType)
        {
            UserType::create(['type'=>$UserType]);
        }
    }
}
