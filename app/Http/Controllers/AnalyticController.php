<?php

namespace App\Http\Controllers;

use App\Models\analytic;
use Illuminate\Http\Request;

class AnalyticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $analytic=analytic::filter()->get();
        return response()->json($analytic, 200);

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
