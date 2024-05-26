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
//            'id' => $this->id,
//            'cart_id' => $this->cart_id,
//            'buyer_id' => $this->buyer_id,
            'name' => $this->buyer->name,
            'comment' => $this->comment,
            'answer'=> $this->response,
            'score' => $this->score,
//            'status' => $this->status,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'foods' => $this->cart->foods->pluck('name')->toArray(),
//            'cart' => new CartResource($this->whenLoaded('cart')),
        ];
    }
}
