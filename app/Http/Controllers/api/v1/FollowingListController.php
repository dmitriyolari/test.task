<?php

declare(strict_types=1);

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\CurrentUserShowInfoService;
use App\Services\FollowingListAddUserService;
use App\Services\FollowingListRemoveUserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class FollowingListController extends Controller
{
    public function addUserToFollowingList(
        User $user,
        FollowingListAddUserService $service,
        CurrentUserShowInfoService $currentUserShowInfoService
    ): Collection|Response|User {
        $currentUserOrFailedResponse = $service->add($user);
        if ($currentUserOrFailedResponse instanceof User) {
            return $currentUserShowInfoService->show();
        }

        return $currentUserOrFailedResponse;
    }

    public function removeUserFromFollowingList(
        User $user,
        FollowingListRemoveUserService $service,
        CurrentUserShowInfoService $currentUserShowInfoService
    ): Collection|Response|User {
        $currentUserOrFailedResponse = $service->remove($user);
        if ($currentUserOrFailedResponse instanceof User) {
            return $currentUserShowInfoService->show();
        }

        return $currentUserOrFailedResponse;
    }
}
