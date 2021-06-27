<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Collection;
use Illuminate\Queue\SerializesModels;

class PostsAboutToExpire extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Collection
     */
    public $posts;
    /**
     * @var User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Collection $posts)
    {
        $this->user = $user;
        $this->posts = $posts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.posts_about_to_expire')->with([
            'user' => $this->user,
            'posts' => $this->posts,
        ]);
    }
}
