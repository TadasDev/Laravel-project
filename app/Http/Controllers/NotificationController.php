<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notification.preferences', [
            'categories' => Category::where('is_active', true)->get()
        ]);
    }

    public function store(Request $request)
    {

     $request->validate([
         'category_id' => ['required']
     ]);

        $results =  $request->category_id; // Array returned

        foreach($results as $result){
            Notifications::updateOrCreate([
                'user_id' => Auth::id(),
                'category_id' => $result,
            ]);
      }

        return redirect()->route('dashboard');

    }
}
