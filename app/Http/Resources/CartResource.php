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
        $totalPrice = $this->foods->reduce(function ($total, $food) {
            $discount = $food->discount ? $food->discount->percentage : 0;
            $priceAfterDiscount = $food->price * (1 - $discount / 100);
            return $total + ($priceAfterDiscount * $food->pivot->count);
        }, 0);

        return [
            'id' => $this->id,
            'buyer_id' => $this->buyer_id,
            'restaurant_id' => $this->restaurant_id,
            'status' => $this->status,
            'total_price' => round($totalPrice, 2),
            'foods' => $this->foods->map(function ($food) {
                return [
                    'id' => $food->id,
                    'name' => $food->name,
                    'count' => $food->pivot->count,
                    'price' => $food->price,
                    'restaurant' => [
                        'name' => $food->restaurant->name,
                        'image' => $food->restaurant->image ? url($food->restaurant->image) : null,
                    ],
                ];
            }),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString()
        ];
    }

}
