<?php

namespace Database\Seeders;

use App\Models\RequestStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


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
            RequestStatus::create(['status'=>$std]);
        }
    }
}
