<?php

namespace App\Http\Controllers\Api;

use App\Events\PostCreated;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Service\PostImagesManager;
use App\Service\PostManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class PostApiController extends Controller
{
    private $postManager;

    public function __construct(
        PostManager $postManager
    ) {
        $this->middleware('auth.basic', ['except' => [
            'index',
            'show'
        ]]);

        $this->postManager = $postManager;
    }

    public function index()
    {
        return Post::all()->where('status','active');
    }

    public function store(Request $request): Post
    {
        $data = array_merge(
            $request->only([
                'title', 'description', 'price', 'category_id', 'expires_at'
            ]),
            ['show_phone_number' => $request->has('show_phone_number')]
        );

        $post = $this->postManager->create($request->user(), $data);

        return $post;
    }

    public function show(Post $post):Post
    {
            return $post;
    }


    public function update(Request $request, Post $post): Post
    {
        $this->authorize('update', $post);

        $post->update($request->only(['title', 'description', 'price','status']));

        return $post;

    }

    public function destroy(Post $post): \Illuminate\Http\JsonResponse
    {
        $this->authorize('delete', $post);

        $post->delete();

        return response()->json([], 204);
    }
}
