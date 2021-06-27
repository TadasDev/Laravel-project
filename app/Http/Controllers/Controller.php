<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

//    public function view()
//    {
//        return view('profile.edit');
//
//    }
//
//    public function edit(Request $request)
//    {
//        $userDetails = Auth::user();  // To get the logged-in user details
//        $user = User::find($userDetails->id);  // Find the user using model and hold its reference
//        $user->email = $request->input('email');
//        $user->phone = $request->input('phone');
//        $user->city = $request->input('city');
//
//        $user->save();  // Update the data
//        redirect('/posts');
//    }

}
