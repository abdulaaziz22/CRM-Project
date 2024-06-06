<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Category::class);
        $Categories=Category::get();
        return response()->json($Categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Category::class);
        $validator = validator::make($request->all(),[
            'name'=>['required','min:2','max:100',Rule::unique('categories')],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $category=Category::create([
            'name'=>$request->name
        ]);
        return response()->json([
            'message'=>'category successfully stored',
            'data'=>$category,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $CheckPoliciy = Category::findOrFail($id);
        $this->authorize('update', $CheckPoliciy);
        $Category = Category::findOrFail($id);
        $validator = validator::make($request->all(),[
            'name'=>['required','min:2','max:100',Rule::unique('categories')->ignore($Category->id)],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $Category->update([
            'name'=>$request->name
        ]);
        return response()->json([
            'message'=>'category successfully stored',
            'data'=>$Category,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $CheckPoliciy = Category::findOrFail($id);
        $this->authorize('delete',$CheckPoliciy);
        $Category=Category::findorfail($id);
        $Category->delete();
        return response()->json([
            'message'=>'Category successfully deleted',
            'data'=>$Category,
        ], 200);
    }
}
