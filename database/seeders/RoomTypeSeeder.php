<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $RoomTypes=['قاعة','دورات مياه','معمل'];
        foreach($RoomTypes as $RoomType){
            RoomType::create(['name'=>$RoomType]);
        }
    }
}
