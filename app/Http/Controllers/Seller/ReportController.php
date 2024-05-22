<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $seller = Auth::guard('seller')->user();

        $restaurantIds = Restaurant::where('seller_id', $seller->id)->pluck('id');

        $startDate = Carbon::now()->subWeek();
        $endDate = Carbon::now();

        if ($request->has('time_period')) {
            switch ($request->input('time_period')) {
                case 'last_month':
                    $startDate = Carbon::now()->subMonth();
                    break;
                case 'last_week':
                default:
                    $startDate = Carbon::now()->subWeek();
                    break;
            }
        }

        $orders = Order::whereIn('restaurant_id', $restaurantIds)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $totalOrders = $orders->count();
        $totalRevenue = $orders->sum('total_price');

        return view('seller.reports.index', compact('orders', 'totalOrders', 'totalRevenue', 'startDate', 'endDate'));
    }

}
