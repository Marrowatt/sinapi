<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $bmr = $this->bmr_harris_benedict();
        if($this->formula_id == 2) $bmr = $this->bmr_mifflin_st_jeor();
        if($this->formula_id == 3) $bmr = $this->bmr_fao_oms();

        return [
            "id" => $this->id,
            "name" => $this->name,
            "user_type" => $this->user_type->name,
            "activity_level" => new ActivityLevelResource($this->whenLoaded('activity_level')),
            "phone" => $this->phone,
            "weight" => $this->weight,
            "height" => $this->height,
            "birthday" => $this->birthday,
            "active" => $this->active ? "Yes" : "No",
            "formula" => $this->formula->name,
            "bmr" => $bmr,
            "predicts" => [
                "bmr_harris_benedict" => $this->bmr_harris_benedict(),
                "bmr_mifflin_st_jeor" => $this->bmr_mifflin_st_jeor(),
                "bmr_fao_oms" => $this->bmr_fao_oms(),
                "ideal_fat_percentage" => $this->ideal_fat_percentage(),
                "ideal_water_consumption" => $this->ideal_water_consumption(),
                "bmi" => $this->bmi(),
                "ideal_macro" => $this->ideal_macro()
            ]
        ];
    }
}
