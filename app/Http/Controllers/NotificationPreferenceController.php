<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\UserNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationPreferenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('notification.preferences', [
            'categories' => Category::where('is_active', true)->get()
        ]);
    }

    public function store(Request $request)
    {

     $request->validate([
         'user_id' => ['required'],
         'category_ids' => ['required']
     ]) ;

        $results =  $request->category_ids;

        foreach($results as $result){
          UserNotifications::create([
                'user_id' => Auth::id(),
                'category_ids' => $result,
            ]);
      }
        return redirect()->route('dashboard');

    }
}
