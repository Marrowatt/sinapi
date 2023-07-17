<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AG extends Model
{
    use HasFactory;

    protected $fillable = ['food_id', 'saturated_g', 'monounsaturated_g', 
        'polyunsaturated_g', 'ag_12_0_g', 'ag_14_0_g', 'ag_16_0_g', 'ag_18_0_g', 'ag_20_0_g', 
        'ag_22_0_g', 'ag_24_0_g', 'ag_14_1_g', 'ag_16_1_g', 'ag_18_1_g', 'ag_20_1_g', 'ag_18_2_n_6_g', 
        'ag_18_3_n_3_g', 'ag_20_4_g', 'ag_20_5_g', 'ag_22_5_g', 'ag_22_6_g', 'ag_18_1t_g', 'ag_18_2t_g',
    ];

    public function food () {
        return $this->belongsTo(Food::class);
    }
}
