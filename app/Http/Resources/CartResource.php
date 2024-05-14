<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'restaurant' => [
                'name' => $this->food->restaurant->name,
                'image' => $this->food->restaurant->image ? url($this->food->restaurant->image) : 'https://picsum.photos/200/300'
            ],
            'foods' => [
                [
                    'id' => $this->food->id,
                    'name' => $this->food->name,
                    'count' => $this->count,
                    'price' => $this->food->price
                ]
            ],
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString()
        ];
    }
}
