<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'bank_account_number' => $this->bank_account_number,
            'is_complete' => $this->is_complete,
            'delivery_cost' => $this->delivery_cost,
            'operational_hours' => $this->formatOperationalHours($this->operational_hours),
            'is_open' => $this->is_open,
            'image' => $this->image ? url($this->image) : null,
        ];
    }

    private function formatOperationalHours($hours)
    {
        $hours = json_decode($hours, true);
        $formatted = [];
        $days = ['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday'];

        foreach ($days as $day) {
            if (isset($hours[$day])) {
                $formatted[$day] = [
                    'start' => $hours[$day]['start'] ?? null,
                    'end' => $hours[$day]['end'] ?? null,
                ];
            } else {
                $formatted[$day] = null;
            }
        }

        return $formatted;
    }
}
