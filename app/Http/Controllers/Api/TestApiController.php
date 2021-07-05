<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class TestApiController extends Controller
{
    public function index()
    {
       $query = DB::table('posts')
            ->join('categories','categories.id','=','posts.category_id')
            ->where('status', ' =' ,'active')
            ->where('is_active',' = ',1);


       $results = $query->get();

   }
}
