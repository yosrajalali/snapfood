@extends('layouts.seller')

@section('title', 'آرشیو سفارشات')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-4xl font-bold text-center text-gray-800">آرشیو سفارشات</h1>

        <!-- Current Orders Section -->
        <div class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
            <h2 class="text-xl mb-4 font-semibold text-gray-700">سفارشات تحویل گرفته شده</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            شماره سفارش
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            مجموع هزینه
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            وضعیت
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
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
@endsection
