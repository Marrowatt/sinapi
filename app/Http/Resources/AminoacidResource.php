<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AminoacidResource extends JsonResource
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
            'tryptophan_g' => $this->tryptophan_g,
            'threonine_g' => $this->threonine_g,
            'isoleucine_g' => $this->isoleucine_g,
            'leucine_g' => $this->leucine_g,
            'lysine_g' => $this->lysine_g,
            'methionine_g' => $this->methionine_g,
            'cystine_g' => $this->cystine_g,
            'phenylalanine_g' => $this->phenylalanine_g,
            'tyrosine_g' => $this->tyrosine_g,
            'valine_g' => $this->valine_g,
            'arginine_g' => $this->arginine_g,
            'histidine_g' => $this->histidine_g,
            'alanine_g' => $this->alanine_g,
            'aspartic_g' => $this->aspartic_g,
            'glutamic_g' => $this->glutamic_g,
            'glycine_g' => $this->glycine_g,
            'proline_g' => $this->proline_g,
            'serine_g' => $this->serine_g,
        ];
    }
}
