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
            'buyer_id' => $this->buyer_id,
            'status' => $this->status,
            'foods' => $this->foods->map(function ($food) {
                return [
                    'id' => $food->id,
                    'name' => $food->name,
                    'price' => $food->price,
                    'count' => $food->pivot->count,
                    'restaurant' => [
                        'id' => $food->restaurant->id ?? null,
                        'name' => $food->restaurant->name ?? 'N/A',
                        'image' => $food->restaurant->image ? url($this->food->restaurant->image) : null,
                    ],
                ];
            }),
            'total_price' => $this->foods->sum(function ($food) {
                $price = $food->price;
                if ($food->discount) {
                    $price = $price * (1 - $food->discount->percentage / 100);
                }
                return $price * $food->pivot->count;
            }),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
