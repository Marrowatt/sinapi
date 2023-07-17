<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use LaravelLegends\EloquentFilter\Concerns\HasFilter;

use App\Models\Food;

class Category extends Model
{
    use HasFactory, HasFilter;

    protected $fillable = ['name'];

    public function foods () {
        return $this->hasMany(Food::class);
    }
}
