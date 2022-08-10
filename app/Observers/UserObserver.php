<?php

namespace App\Observers;

use App\Models\NutritionalGuidance;

class UserObserver
{
    public function created () {

        \Log::info("eeeeeeeeeeeeeeeeeeeeeeee");

        NutritionalGuidance::create([
            "user_id" => $this->id,
        ]);
    }
}
