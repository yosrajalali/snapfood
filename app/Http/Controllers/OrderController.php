<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function updateOrderStatus(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->status_id = $request->status_id;
        $order->save();

        return redirect()->back()->with('success', 'وضعیت سفارش با موفقیت به‌روزرسانی شد.');
    }

    public function archivedOrders()
    {
        $deliveredStatusId = OrderStatus::query()->where('name', 'تحویل گرفته شد')->first()->id;

        $archivedOrders = Order::query()->where('status_id', $deliveredStatusId)
            ->latest()
            ->paginate(7);
        return view('seller.order.archived-orders', compact('archivedOrders'));
    }



}
