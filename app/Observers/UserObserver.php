<?php

namespace App\Observers;

use App\Models\User;
use App\Services\FileService;

class UserObserver
{
    public function updating(User $user)
    {
        FileService::deleteAvatar($user);
    }

    public function deleted(User $user)
    {
        FileService::deleteAvatar($user);
    }
}
