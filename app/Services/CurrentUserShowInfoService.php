<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CurrentUserShowInfoService
{
    public function show(): User
    {
        $user = Auth::user();
        $currentUserIsFollowing = $user->followers;
        $currentUserIsFollowedBy = $user->followed;
        unset($user->followed, $user->followers);

        $realUserFollowers = $currentUserIsFollowing->diff($currentUserIsFollowedBy);
        $realUsersCurrentUserIsFollowing = $currentUserIsFollowedBy->diff($currentUserIsFollowing);
        $userFriends = $currentUserIsFollowedBy->intersect($currentUserIsFollowing);

        $user->userFollowers = $realUserFollowers;
        $user->userIsFollowing = $realUsersCurrentUserIsFollowing;
        $user->userFriends = $userFriends;

        return $user;
    }
}
