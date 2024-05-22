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
        $UserTypes = ['ادمن','العميد' , 'دكتور' , 'امين الكلية' ];
        foreach($UserTypes as $UserType)
        {
            UserType::create(['type'=>$UserType])->permission()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9 , 10 , 11 , 12 , 13 , 14 , 15 , 16]);
        }
    }
}
