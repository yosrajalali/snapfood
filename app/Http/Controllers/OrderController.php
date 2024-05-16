<?php

namespace App\Http\Controllers;

use App\Mail\OrderStatusChangedMail;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function updateOrderStatus(Request $request, $orderId)
    {
        $order = Order::with(['cart.buyer', 'status'])->findOrFail($orderId);

        $order->status_id = $request->status_id;
        $order->save();

        // Check if the order has a cart and that cart has a buyer
        if (!$order->cart || !$order->cart->buyer) {
            return redirect()->back()->with('error', 'No associated buyer found for this order.');
        }

        Mail::to($order->cart->buyer->email)->queue(new OrderStatusChangedMail($order));
        return redirect()->back()->with('success', __('response.status_order.update'));
    }


    public function archivedOrders()
    {
        $deliveredStatusId = OrderStatus::query()->where('name', 'تحویل گرفته شد')->first()->id;

        $seller = Auth::user();
        $restaurantId = $seller->restaurant->id;
        $archivedOrders = Order::query()
            ->where('restaurant_id', $restaurantId)
            ->where('status_id', $deliveredStatusId)
            ->latest()
            ->paginate(7);
        return view('seller.order.archived-orders', compact('archivedOrders'));
    }



}
