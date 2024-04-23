<?php

namespace App\Http\Controllers;

use App\Models\Order;
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

}
