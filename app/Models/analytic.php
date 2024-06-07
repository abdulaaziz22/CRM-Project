<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mehradsadeghi\FilterQueryString\FilterQueryString;

class analytic extends Model
{
    use HasFactory,FilterQueryString;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date','total_requests','completed_requests'];
    protected $filters = ['date'];


    public function date($query, $value)
    {
    $dateComponents = explode('-', $value);

    if (count($dateComponents) == 2) {
        $year = $dateComponents[0];
        $month = $dateComponents[1];

        $result=$query->selectRaw('DAY(date) as day, MONTH(date) as month, YEAR(date) as year, SUM(total_requests) as total_requests, SUM(completed_requests) as completed_requests')
                      ->whereMonth('date', $month)
                      ->whereYear('date', $year)
                      ->groupBy('day', 'month', 'year')
                      ->get()
                      ->toarray();
        $total_requests=array_column($result, 'total_requests');
        $completed_requests =array_column($result, 'completed_requests');
        $output = [
            'total_requests' => $total_requests,
            'completed_requests' => $completed_requests
        ];
        return  $output;
    } elseif(count($dateComponents) == 1) {
        $year = $dateComponents[0];
        $result=$query->selectRaw('MONTH(date) as month, SUM(total_requests) as total_requests, SUM(completed_requests) as completed_requests')
        ->whereYear('date', $year)
        ->groupBy('month')
        ->get()
        ->toarray();
        $total_requests=array_column($result, 'total_requests');
        $completed_requests =array_column($result, 'completed_requests');
        $output = [
            'total_requests' => $total_requests,
            'completed_requests' => $completed_requests
        ];
        return  $output;
    }
    else{
        return $query;
    }
    }
}
