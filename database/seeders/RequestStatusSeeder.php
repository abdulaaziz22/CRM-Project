<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Request_Status;


class RequestStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = ['معلق','قيد التنفيد','مكتمل'];
        foreach($status as $std)
        {
            Request_Status::create(['status'=>$std]);
        }
    }
}
