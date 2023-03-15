<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\StatusResource;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class FollowingListAddUserService
{
    public function add(User $user): Response|User
    {
        $userToFriendId = $user->id;
        $currentUser = Auth::user();
        $currentUserFriends = $currentUser->followed;

        if ($currentUser->id === $userToFriendId || $currentUserFriends->firstWhere('id', $userToFriendId)) {
            return response(StatusResource::make(false), 403);
        }
        $currentUser->followed()->attach($userToFriendId);

        return $currentUser;
    }

}
