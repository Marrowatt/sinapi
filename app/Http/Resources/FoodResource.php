<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
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
            "category" => new CategoryResource($this->whenLoaded('category')),
            "cmvcol" => new CMVColResource($this->whenLoaded('cmvcol')),
            "aminoacid" => new AminoacidResource($this->whenLoaded('aminoacid')),
            "ag" => new AGResource($this->whenLoaded('ag')),
        ];
    }
}
