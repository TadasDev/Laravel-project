<?php

namespace App\Events;

use App\Models\Post;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;


class PostCreated
{
    use Dispatchable, InteractsWithSockets ;

    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
}
