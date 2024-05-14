<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetCartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'food_id' => $this->food_id,
            'count' => $this->count,
            'food_name' => $this->food->name, // Ensure there is a relationship defined in the Cart model to Food
            'restaurant' => [
                'name' => $this->food->restaurant->name, // Ensure Food model has relationship to Restaurant
                'image' => $this->food->restaurant->image
            ],
            'price' => $this->food->price,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString()
        ];
    }
}
