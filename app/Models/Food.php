<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use LaravelLegends\EloquentFilter\Concerns\HasFilter;

class Food extends Model
{
    use HasFactory, HasFilter;

    protected $fillable = ['name', 'category_id'];

    public function category () {
        return $this->belongsTo(Category::class);
    }

    public function cmvcol () {
        return $this->hasOne(CMVCol::class);
    }    

    public function ag () {
        return $this->hasOne(AG::class);
    }

    public function aminoacid () {
        return $this->hasOne(Aminoacid::class);
    } 
}
