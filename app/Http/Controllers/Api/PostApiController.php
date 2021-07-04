<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Service\PostManager;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Service\CurrencyConverter;



class PostApiController extends Controller
{
    private $postManager;

    public $currencyConverter;

    public function __construct(
        CurrencyConverter $currencyConverter,
        PostManager $postManager

    ) {
        $this->middleware('auth.basic', ['except' => [
            'index',
            'show'
        ]]);
        $this->currencyConverter = $currencyConverter;
        $this->postManager = $postManager;
    }


    public function index()
    {
           $posts =  Post::all();
           foreach ($posts as $post){
              $this->setUsdPriceOnPost($post);
           }
           return $posts;
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
            return $this->setUsdPriceOnPost($post);
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

    public function setUsdPriceOnPost(Post $post )
    {
        return  $post->setAttribute('priceUsd',$this->currencyConverter->convertToUsd($post->price));
    }
}
