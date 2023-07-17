<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AGResource extends JsonResource
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
            "food" => new FoodResource($this->whenLoaded('food')),
            'saturated_g' => $this->saturated_g,
            'monounsaturated_g' => $this->monounsaturated_g,
            'polyunsaturated_g' => $this->polyunsaturated_g,
            '12:0_g' => $this->ag_12_0_g,
            '14:0_g' => $this->ag_14_0_g,
            '16:0_g' => $this->ag_16_0_g,
            '18:0_g' => $this->ag_18_0_g,
            '20:0_g' => $this->ag_20_0_g,
            '22:0_g' => $this->ag_22_0_g,
            '24:0_g' => $this->ag_24_0_g,
            '14:1_g' => $this->ag_14_1_g,
            '16:1_g' => $this->ag_16_1_g,
            '18:1_g' => $this->ag_18_1_g,
            '20:1_g' => $this->ag_20_1_g,
            '18:2 n-6_g' => $this->ag_18_2_n_6_g,
            '18:3 n-3_g' => $this->ag_18_3_n_3_g,
            '20:4_g' => $this->ag_20_4_g,
            '20:5_g' => $this->ag_20_5_g,
            '22:5_g' => $this->ag_22_5_g,
            '22:6_g' => $this->ag_22_6_g,
            '18:1t_g' => $this->ag_18_1t_g,
            '18:2t_g' => $this->ag_18_2t_g,
        ];
    }
}
