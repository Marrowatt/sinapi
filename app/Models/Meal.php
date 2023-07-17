<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = ['nutritional_guidance_id', 'hour', 'nickname', 'active', 'notifiable', 'done'];

    public function meal_food () {
        return $this->hasMany(MealFood::class);
    }
}
