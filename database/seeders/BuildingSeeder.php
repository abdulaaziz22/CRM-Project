<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['A', 'B', 'C', 'D'];
        $collegeIds = [1, 2, 3, 1];
        for ($i = 0; $i < count($names); $i++) {
            Building::create([
                'name' => $names[$i],
                'college_id' => $collegeIds[$i],
            ]);
        }
        // Building::create(['name'=>'A','college_id'=>'1']);
        // Building::create(['name'=>'B','college_id'=>'1']);
        // Building::create(['name'=>'C','college_id'=>'1']);
        // Building::create(['name'=>'D','college_id'=>'1']);
    }
}
