<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();

    }

    public function store(Request $request)
    {
        $category = Category::create([
            'name' => $request['name'],
            'path' => $request['path'],
            'is_active' => $request['is_active'],
            'is_root' => $request['is_root'],
            'parent_id' => $request['parent_id'],
        ]);

        $categories = Category::with('children')->where('parent_id',5)->get();

        dd($categories);
        die();
//        $catpath = Category::all();
//
//        foreach ($catpath as $value){
//            $path = $value->path;
//
//            $pathExploded = explode('/',$path); //  [1,2,3]
//
//            $pathLenght = count($pathExploded); // 3 levels
//
////            dd($pathLenght);



        return response()->json($categories);
    }

    public function show(Category $category):CategoryResource
    {

            return new CategoryResource($category);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Category $category)
    {

        $category->delete();

        return response()->json([],204);
    }
}
