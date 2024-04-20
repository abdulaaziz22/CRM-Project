<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'awad',
            'password'=>'12121212',
            'user_type_id'=>1,
            'username'=>'awad1234',
            'phone'=>'777777777',
        ]);
    }
}
