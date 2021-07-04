<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Models\Post;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Service\PostManager;
use App\Service\PostImagesManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    const PAGE_SIZE = 5;

    private $postManager;
    private $postImagesManager;

    public function __construct(
        PostManager $postManager,
        PostImagesManager $postImagesManager
    ) {
        $this->middleware('auth', ['except' => [
            'index'
        ]]);

        $this->postManager = $postManager;
        $this->postImagesManager = $postImagesManager;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('posts', [
            'posts' => Post::where('status', 'active')->orderBy('created_at', 'desc')->paginate(self::PAGE_SIZE)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('posts.create', [
            'categories' => Category::where('is_active', true)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $data = array_merge(
            $request->only([
                'title', 'description', 'price', 'category_id', 'expires_at'
            ]),
            ['show_phone_number' => $request->has('show_phone_number')]
        );

//        $post = $this->postManager->create($request->user(), $data);
//
//        PostCreated::dispatch($post);
//
//        if ($request->hasFile('images')) {
//            $this->postImagesManager->appendToPost($post, $request->file('images'));
//        }

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
       //
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('delete', $post);

        $post->delete();

        return back();
    }
}
