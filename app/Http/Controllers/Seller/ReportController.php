<?php

namespace App\Http\Controllers\Seller;

use App\Charts\OrdersChart;
use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


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

        $chart = new OrdersChart($seller->id,$startDate, $endDate);

        return view('seller.reports.index', compact('orders', 'totalOrders', 'totalRevenue', 'startDate', 'endDate', 'chart'));
    }

    public function export(Request $request): BinaryFileResponse|RedirectResponse
    {
        $seller = Auth::guard('seller')->user();

        $restaurant = Restaurant::where('seller_id', $seller->id)->first();

        if (!$restaurant) {
            return redirect()->back()->with('error', 'Restaurant not found for the current seller.');
        }

        return Excel::download(new OrdersExport($seller->id), 'orders.xlsx');
    }

}


