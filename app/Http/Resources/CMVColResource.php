<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CMVColResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            'food_id' => new FoodResource($this->whenLoaded('food')),
            'humidity_percents' => $this->humidity_percents,
            'energy_kcal' => $this->energy_kcal,
            'energy_kj' => $this->energy_kj,
            'protein_g' => $this->protein_g,
            'lipidius_g' => $this->lipidius_g,
            'cholesterol_mg' => $this->cholesterol_mg,
            'carbohydrate_g' => $this->carbohydrate_g,
            'fiber_g' => $this->fiber_g,
            'ashes_g' => $this->ashes_g,
            'calcium_mg' => $this->calcium_mg,
            'magnesium_mg' => $this->magnesium_mg,
            'manganese_mg' => $this->manganese_mg,
            'phosphorus_mg' => $this->phosphorus_mg,
            'iron_mg' => $this->iron_mg,
            'sodium_mg' => $this->sodium_mg,
            'potassium_mg' => $this->potassium_mg,
            'copper_mg' => $this->copper_mg,
            'zinc_mg' => $this->zinc_mg,
            'retinol_mcg' => $this->retinol_mcg,
            're_mcg' => $this->re_mcg,
            'rae_mcg' => $this->rae_mcg,
            'tiamina_mg' => $this->tiamina_mg,
            'riboflavin_mg' => $this->riboflavin_mg,
            'pyridoxine_mg' => $this->pyridoxine_mg,
            'niacin_mg' => $this->niacin_mg,
            'vitaminC_mg' => $this->vitaminC_mg,
        ];
    }
}
