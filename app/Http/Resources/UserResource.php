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
            "predicts" => [
                "BMR Harris-Benedict" => $this->bmr_harris_benedict(),
                "BMR Mifflin St-Jeor" => $this->bmr_mifflin_st_jeor(),
                "BMR FAO/OMS" => $this->bmr_fao_oms(),
                "Ideal Fat Percentage" => $this->ideal_fat_percentage(),
                "Ideal Water Consumption" => $this->ideal_water_consumption(),
                "BMI" => $this->bmi(),
            ]
        ];
    }
}
