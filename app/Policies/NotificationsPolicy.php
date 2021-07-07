<?php

namespace App\Policies;

use App\Http\Resources\NotificationsResource;
use App\Models\User;
use App\Models\Notifications;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;


class NotificationsPolicy
{
    use HandlesAuthorization;

    public function rightsToExecute( User $user, Notifications $notifications)
    {

         return $user->id === $notifications->user_id;
    }



}
