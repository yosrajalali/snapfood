<?php

namespace App\Charts;

use App\Models\Order;
use App\Models\Restaurant;
use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class OrdersChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @param int $sellerId
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return void
     */
    public function __construct(int $sellerId, Carbon $startDate, Carbon $endDate)
    {
        parent::__construct();

        $restaurantIds = Restaurant::where('seller_id', $sellerId)->pluck('id');

        $labels = [];
        $data = [];

        $currentDate = $startDate->copy()->addDay();
        while ($currentDate->lte($endDate)) {
            $labels[] = $currentDate->format('Y-m-d');
            $data[] = Order::whereIn('restaurant_id', $restaurantIds)
                ->whereDate('created_at', $currentDate)
                ->count();
            $currentDate->addDay();
        }

        $this->labels($labels);
        $this->dataset('سفارشات', 'line', $data)
            ->options([
                'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'borderWidth' => 1
            ]);
    }
}


