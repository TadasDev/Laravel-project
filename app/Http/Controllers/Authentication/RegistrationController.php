<?php

namespace App\Http\Controllers\Authentication;

use App\Events\UserRegistered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('authentication.registration');
    }

    /**
     * @throws ValidationException
     */
    public function save(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|unique:users|email:rfc,dns',
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'phone' => 'required|max:30',
                'city' => 'required|max:255',
                'password' => [
                    'required',
                    'confirmed',
                    Password::min(4)
                ],
            ]
        );

       $user = User::create([
            'email' => $request['email'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone' => $request['phone'],
            'city' => $request['city'],
            'is_admin'=> 0 ,
            'password' => Hash::make($request['password']),
        ]);

        UserRegistered::dispatch($user);

        auth()->attempt($request->only('email', 'password'));



        return redirect()->route('dashboard');
    }
}
