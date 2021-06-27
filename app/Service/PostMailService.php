<?php

namespace App\Service;

use App\Models\User;
use App\Models\Post;
use App\Mail\PostCreated;
use App\Mail\PostsAboutToExpire;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Collection;

class PostMailService
{
    public function informUserPostCreated( Post $post ): void
    {
        Mail::to($post->user())->send(new PostCreated($post));
    }

    public function informUserPostsAboutToExpire(User $user, Collection $posts): void
    {
        Mail::to($user)->send(new PostsAboutToExpire($user, $posts));
    }
}
