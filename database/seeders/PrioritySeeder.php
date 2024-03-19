<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\priority;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $priorities = ['غير عاجل','عاجل'];
        foreach($priorities as $priority)
        {
            priority::create(['name'=>$priority]);
        }
    }
}
