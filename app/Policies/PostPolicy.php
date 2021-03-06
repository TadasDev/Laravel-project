<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Post $post): bool
    {
        return $user->is_admin || $user->id === $post->user_id;
    }

    public function star(User $user, Post $post): bool
    {
        return $post->user_id !== $user->id
            && $post->starredBy($user) === false;
    }

    public function unstar(User $user, Post $post): bool
    {
        return $post->user_id !== $user->id
            && $post->starredBy($user) === true;
    }

    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id || $user->is_admin;
    }

}
