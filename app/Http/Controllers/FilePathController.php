<?php

namespace App\Http\Controllers;

use App\Models\FilePath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilePathController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public static function store($files,$request_id,$tracking_id)
    {
        foreach ($files as $file) {
            $File_name=uniqid('',true).'.'.$file->getclientoriginalextension();
            $path=Storage::putFileAs('Request',$file,$File_name);
            $filePath = FilePath::create([
                'path' => $path,
                'tracking_id'=>$tracking_id,
                'request_id'=>$request_id
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FilePath $filePath)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FilePath $filePath)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FilePath $filePath)
    {
        //
    }
}
