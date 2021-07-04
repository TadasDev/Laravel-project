<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
        return view('profile.edit');

    }

    public function edit(Request $request)
    {
        $user = User::find(Auth::id());
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->city = $request->input('city');
        $user->save();  // Update the data

        return redirect()->route('dashboard')->with('message','your profile details have been updated');

    }
}
