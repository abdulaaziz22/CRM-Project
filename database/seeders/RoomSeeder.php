<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::create([
            'name'=>'101',
            'build_id'=>'1',
            'type_id'=>'1',
        ]);
        Room::create([
            'name'=>'102',
            'build_id'=>'2',
            'type_id'=>'3',
        ]);
    }
}
