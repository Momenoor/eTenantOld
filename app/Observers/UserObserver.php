<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserObserver
{
    public function creating(User $user)
    {

        if (!$user->password) {
            $user->password = Hash::make(123456);
        } else {
            $user->password = Hash::make($user->password);
        }
    }
}
