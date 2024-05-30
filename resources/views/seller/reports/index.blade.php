@extends('layouts.seller')

@section('title', 'گزارشات فروشنده')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-5">گزارشات فروشنده</h1>

        <div class="mb-5">
            <form action="{{ route('seller.reports.index') }}" method="GET" class="flex items-center">
                <label for="time_period" class="mr-2">فیلتر بر اساس زمان:</label>
                <select name="time_period" id="time_period" class="text-sm border-gray-300 rounded p-2">
                    <option value="last_week" {{ request('time_period') == 'last_week' ? 'selected' : '' }}>هفته گذشته</option>
                    <option value="last_month" {{ request('time_period') == 'last_month' ? 'selected' : '' }}>ماه گذشته</option>
                </select>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2">اعمال فیلتر</button>
            </form>
        </div>

        <div class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
            <h2 class="text-xl mb-4 font-semibold text-gray-700">آمار کل</h2>
            <p>تعداد کل سفارشات: {{ $totalOrders }}</p>
            <p>درآمد کل: {{ number_format($totalRevenue, 2) }} تومان</p>
        </div>

        <div class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
            <h2 class="text-xl mb-4 font-semibold text-gray-700">جزئیات سفارشات</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">شماره سفارش</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">مجموع هزینه</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">وضعیت</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">تاریخ سفارش</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $order->id }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ number_format($order->total_price, 2) }} تومان</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $order->status->name }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $order->created_at->format('Y/m/d') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
            <h2 class="text-xl mb-4 font-semibold text-gray-700">نمودار سفارشات</h2>
            <div>{!! $chart->container() !!}</div>
        </div>

        <div class="mt-5">
            <a href="{{ route('seller.reports.export',  ['time_period' => request('time_period')]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">خروجی اکسل</a>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {!! $chart->script() !!}
@endsection
