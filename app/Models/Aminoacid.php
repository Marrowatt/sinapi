<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aminoacid extends Model
{
    use HasFactory;

    protected $fillable = ['food_id', 'tryptophan_g', 'threonine_g', 
        'isoleucine_g', 'leucine_g', 'lysine_g', 'methionine_g', 'cystine_g', 
        'phenylalanine_g', 'tyrosine_g', 'valine_g', 'arginine_g', 'histidine_g', 
        'alanine_g', 'aspartic_g', 'glutamic_g', 'glycine_g', 'proline_g', 'serine_g',
    ];

    public function food () {
        return $this->belongsTo(Food::class);
    }
}
