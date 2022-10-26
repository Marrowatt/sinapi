<?php

namespace App\Observers;

use App\Models\NutritionalGuidance;
use App\Models\User;

class UserObserver
{
    public function created (User $user) {

        NutritionalGuidance::create([
            "user_id" => $user->id,
        ]);
    }
}
