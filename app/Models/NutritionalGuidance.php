<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionalGuidance extends Model
{
    use HasFactory;

    protected $fillable = ['nutritionist_id', 'user_id'];

    public function meals () {
        return $this->hasMany(Meal::class);
    }

    // public function nutritionist () {
    //     return $this->belongsTo(User::class);
    // }

    public function patient () {
        return $this->belongsTo(User::class, 'id');
    }
}
