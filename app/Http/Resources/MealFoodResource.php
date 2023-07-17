<?php

namespace App\Http\Resources;

use App\Http\Resources\FoodResource;

use Illuminate\Http\Resources\Json\JsonResource;

class MealFoodResource extends JsonResource
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
            "food" => new FoodResource($this->food),
            'quantity' => $this->quantity
        ];
    }
}
