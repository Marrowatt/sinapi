<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CMVCol extends Model
{
    use HasFactory;

    protected $fillable = ['variation_id', 'humidity_percents', 'energy_kcal', 
        'energy_kj', 'protein_g', 'lipidius_g', 'cholesterol_mg', 'carbohydrate_g', 
        'fiber_g', 'ashes_g', 'calcium_mg', 'magnesium_mg', 'manganese_mg', 
        'phosphorus_mg', 'iron_mg', 'sodium_mg', 'potassium_mg', 'copper_mg', 'zinc_mg', 
        'retinol_mcg', 're_mcg', 'rae_mcg', 'tiamina_mg', 'riboflavin_mg', 
        'pyridoxine_mg', 'niacin_mg', 'vitaminC_mg'
    ];
}
