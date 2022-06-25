<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AG extends Model
{
    use HasFactory;

    protected $fillable = ['variation_id', 'saturated_g', 'monounsaturated_g', 
        'polyunsaturated_g', '12:0_g', '14:0_g', '16:0_g', '18:0_g', '20:0_g', 
        '22:0_g', '24:0_g', '14:1_g', '16:1_g', '18:1_g', '20:1_g', '18:2 n-6_g', 
        '18:3 n-3_g', '20:4_g', '20:5_g', '22:5_g', '22:6_g', '18:1t_g', '18:2t_g',
    ];
}
