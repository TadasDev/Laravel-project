<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Events\UserRegistered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index(): Collection
    {
        return User::all();
    }

    public function store(Request $request): JsonResponse
    {
        $this->validate(
            $request,
            [
                'email' => 'required|unique:users|email:rfc,dns',
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'phone' => 'required|max:30',
                'city' => 'required|max:255',
//                'password' => [
////                    'required',
//                    Password::min(4)
//                ],
            ]
        );

        $user = User::create([
            'email' => $request['email'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone' => $request['phone'],
            'city' => $request['city'],
            'is_admin' => 0,
            'password' => Hash::make($request['password']),
        ]);

        UserRegistered::dispatch($user);

        return response()->json($user);
    }

    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    public function update(Request $request, $id)
    {
        // TODO: will do on monday
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([], 204);
    }
}
