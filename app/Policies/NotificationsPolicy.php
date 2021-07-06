<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Notifications;
use Illuminate\Auth\Access\HandlesAuthorization;


class NotificationsPolicy
{
    use HandlesAuthorization;

    public function show( User $user , Notifications $notifications)
    {

       return $user->id === $notifications->user_id;

    }

}
