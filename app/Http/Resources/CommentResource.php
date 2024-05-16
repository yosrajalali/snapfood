<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'comment' => $this->comment,
            'score' => $this->score,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'cart' => [
                'id' => $this->cart->id,
                'count' => $this->cart->count,
                'status' => $this->cart->status,
                'food' => [
                    'id' => $this->cart->food->id,
                    'name' => $this->cart->food->name,
                    'ingredients' => $this->cart->food->ingredients,
                    'price' => $this->cart->food->price,
                    'image' => url($this->cart->food->image),
                ]
            ]
        ];
    }
}
