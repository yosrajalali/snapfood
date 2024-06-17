<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SellerController extends Controller
{
//    public function index(): View
//    {
//
//        $seller = Auth::user();
//        $restaurant = $seller->restaurant;
//        $isRestaurantInfoComplete = $restaurant ? $restaurant->is_complete : false;
//
//        return view('seller.index', compact('isRestaurantInfoComplete'));
//    }

//    public function dashboard()
//    {
//        $xDaysAgo = Carbon::now()->subDays(10);
//        $deliveredStatusId = OrderStatus::where('name', 'تحویل گرفته شد')->first()->id;
//
//        $seller = Auth::user();
//        $restaurantId = $seller->restaurant->id;
//
//        $recentOrders = Order::where('created_at', '>=', $xDaysAgo)
//            ->where('restaurant_id', $restaurantId)
//            ->where('status_id', '!=', $deliveredStatusId)
//            ->latest()
//            ->with(['cart.foods'])
//            ->paginate(7);
//        $statuses = OrderStatus::all();
//
//        return view('seller.order.recentOrders', compact('recentOrders','statuses'));
//    }
}
