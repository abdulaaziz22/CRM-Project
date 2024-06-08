<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\analytic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $analytic=analytic::filter();
        return response()->json($analytic, 200);

    }
    public function topUsers()
    {
        $result = User::select('users.id', 'users.name', 
        DB::raw('COUNT(trackings.id) as total_tracking'),
        DB::raw('SUM(CASE WHEN trackings.enddate IS NOT NULL THEN 1 ELSE 0 END) as completed_tracking'))
        ->leftJoin('trackings', 'users.id', '=', 'trackings.to_user_id')
        ->groupBy('users.id', 'users.name')
        ->orderByDesc(DB::raw('SUM(CASE WHEN trackings.enddate IS NOT NULL THEN 1 ELSE 0 END) / COUNT(trackings.id) * 100'))
        ->take(10)
        ->get()
        ->map(function ($item) {
            $item->completion_rate = $item->total_tracking == 0 ? 0 : ($item->completed_tracking / $item->total_tracking * 100);
            return $item;
        })
        ->values()
        ->toArray();

return [
    'users' => array_column($result, 'name'),
    'completion_rates' => array_column($result, 'completion_rate')
];

        
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(analytic $analytic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, analytic $analytic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(analytic $analytic)
    {
        //
    }
}
