<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Collection;

class PostRepository
{
    public function findExpiringPostsForUser(User $user): Collection
    {
        $query = $user->posts()
            ->where('status', 'active')
            ->where(
                'expires_at',
                now()->addDays(1)->setTime(0, 0)
            )
            ->take(3);

        return $query->get();
    }
}
