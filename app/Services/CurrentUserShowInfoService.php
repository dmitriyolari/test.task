<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\User\UserCollection;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CurrentUserShowInfoService
{
    public function show(int $id = null): User
    {
        $id ? $user = User::find($id)
            : $user = Auth::user();

        $currentUserIsFollowing = $user->followers;
        $currentUserIsFollowedBy = $user->followed;
        unset($user->followed, $user->followers);

        $realUserFollowers = $currentUserIsFollowing->diff($currentUserIsFollowedBy);
        $realUsersCurrentUserIsFollowing = $currentUserIsFollowedBy->diff($currentUserIsFollowing);
        $userFriends = $currentUserIsFollowedBy->intersect($currentUserIsFollowing);

        $user->userFollowers = new UserCollection($realUserFollowers);
        $user->userIsFollowing = new UserCollection($realUsersCurrentUserIsFollowing);
        $user->userFriends = new UserCollection($userFriends);

        return $user;
    }
}
