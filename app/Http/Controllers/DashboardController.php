<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    private const PAGE_SIZE = 5;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = auth()->user();

        // #1 budas
        // $posts = Post::where('user_id', $user['id'])->get();
        // #2 budas
        $posts = $user->posts();

        if ($request['status'] === null) {
            $request->merge(['status' => 'active']);
        }
        $this->validate($request, [
            'status' => ['required', Rule::in(['active', 'inactive', 'closed'])]
        ]);
        $posts->where('status', $request['status'])->orderBy('created_at', 'desc');

        return view('dashboard', [
            'posts' => $posts->paginate(self::PAGE_SIZE)
        ]);
    }
}
