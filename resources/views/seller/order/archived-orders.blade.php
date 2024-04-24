<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>آرشیو سفارشات</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200">
<div class="container mx-auto px-4 py-6">
    <h1 class="text-4xl font-bold text-center text-gray-800">آرشیو سفارشات</h1>

    <!-- Dashboard Navigation -->
    <div class="flex justify-around mt-8 mb-4 text-sm">
        <a href="{{route('seller.dashboard')}}" class="bg-pink-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">سفارشات کنونی</a>
        <a href="{{route('seller.archived-orders')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">سفارشات آرشیو شده</a>
        <a href="{{route('seller.foods.index')}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">غذاها</a>
        <a href="#" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">گزارش فروش</a>
        <a href="#" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">تنظیمات رستوران</a>
        <a href="{{ route('seller.index') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">بازگشت به صفحه اصلی</a>

    </div>

    <!-- Current Orders Section -->
    <div class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
        <h2 class="text-xl mb-4 font-semibold text-gray-700">سفارشات تحویل گرفته شده</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100  text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        شماره سفارش
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        مجموع هزینه
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100  text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        وضعیت
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100  text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        تاریخ سفارش
                    </th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($archivedOrders as $order)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $order->id }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ number_format($order->total_price, 2) }} تومان
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $order->status->name }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $order->created_at->format('Y/m/d') }}
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
            <div class="px-5 py-5">
                {{ $archivedOrders->links() }}
            </div>
        </div>
    </div>
</div>
</body>
</html>

