<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function findUsersWithExpiringPosts(): Collection
    {
        $query = DB::table('users')
            ->join('posts', 'posts.user_id', '=', 'users.id')
            ->where(
                'posts.expires_at',
                now()->addDays(1)->setTime(0, 0)
            )
            ->where('posts.status', 'active')
            ->distinct();

        $users = $query->get('users.*');

        return User::hydrate($users->all());
    }
}
