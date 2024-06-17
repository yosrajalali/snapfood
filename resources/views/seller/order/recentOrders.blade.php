@extends('layouts.seller')

@section('title', 'سفارشات جاری')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-5">سفارشات جاری</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-5" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-5" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <!-- Current Orders Section -->
        <div class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
            <h2 class="text-xl mb-4 font-semibold text-gray-700">سفارشات جاری</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            شماره سفارش
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            نام غذا
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            تعداد
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            مجموع هزینه
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            وضعیت
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            تاریخ سفارش
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($recentOrders as $order)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $order->id }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                @foreach ($order->cart->foods as $food)
                                    <div>{{ $food->name }}</div>
                                @endforeach
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                @foreach ($order->cart->foods as $food)
                                    <div>{{ $food->pivot->count }}</div>
                                @endforeach
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ number_format($order->total_price, 2) }} تومان
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <form action="{{ route('seller.orders.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    <select name="status_id" class="text-sm bg-gray-100 border border-gray-300 rounded">
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}" {{ $order->status_id == $status->id ? 'selected' : '' }}>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="mt-2 bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-800">ثبت وضعیت</button>
                                </form>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $order->created_at->format('Y/m/d') }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="px-5 py-5">
                    {{ $recentOrders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
