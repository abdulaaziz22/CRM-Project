<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  App\Models\analytic;

class analyticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $start_date = '2023-01-01';
    $end_date = '2024-06-07';

    $date = array();
    $current_date = strtotime($start_date);
    $end_date_timestamp = strtotime($end_date);

    while ($current_date <= $end_date_timestamp) {
        $date[] = date('Y-m-d', $current_date);
        $current_date = strtotime('+1 day', $current_date);
    }

    for ($i = 0; $i < count($date); $i++) {
        $totalRequests = random_int(1, 50);
        $completedRequests = random_int(1, 50);

        analytic::create([
            'date' => $date[$i],
            'total_requests' => $totalRequests,
            'completed_requests' => $completedRequests
        ]);
    }
        
    }
}
