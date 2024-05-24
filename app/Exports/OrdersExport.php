<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class OrdersExport implements FromCollection, WithHeadings
{
    protected $sellerId;

    public function __construct(int $sellerId)
    {
        $this->sellerId = $sellerId;
    }

    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return Order::whereHas('restaurant', function ($query) {
            $query->where('seller_id', $this->sellerId);
        })->get()->map(function($order) {
            return [
                'id' => $order->id,
                'restaurant_id' => $order->restaurant_id,
                'cart_id' => $order->cart_id,
                'status_id' => $order->status_id,
                'total_price' => $order->total_price,
                'created_at' => Carbon::parse($order->created_at)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::parse($order->updated_at)->format('Y-m-d H:i:s'),
            ];
        });
    }

    /**
     * Define the headers for the export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Restaurant ID',
            'Cart ID',
            'Status ID',
            'Total Price',
            'Created At',
            'Updated At'
        ];
    }
}
