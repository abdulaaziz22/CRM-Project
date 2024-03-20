<?php

namespace App\Http\Controllers;

use App\Models\RequestStatus;
use Illuminate\Http\Request;

class RequestStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Status=RequestStatus::get();
        return response()->json($Status, 200);

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
    public function show(Request_Status $request_Status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Request_Status $request_Status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request_Status $request_Status)
    {
        //
    }
}
