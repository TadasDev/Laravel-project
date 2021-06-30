<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class CategoryPolicy

{
    use HandlesAuthorization;

    public function destroy(User $user): bool
    {
        return $user->is_admin;
    }

    public function store(User $user)
    {
        return $user->is_admin;
    }

    public function update(User $user)
    {
        return $user->is_admin ;
    }
}
