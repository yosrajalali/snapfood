@extends('layouts.seller')

@section('title', 'نظرات کاربران')

@section('content')
    <div class="container mx-auto px-4 py-6 w-full xs:w-3/5 sm:w-full md:full lg:w-3/5 xl:w-full">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-5">نظرات کاربران</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                {{ session('warning') }}
                <form action="{{ route('seller.comments.response', session('comment_id')) }}" method="POST">
                    @csrf
                    <textarea name="response" rows="2" class="w-full mt-2 p-2 border rounded focus:ring focus:ring-blue-200 focus:border-blue-500">{{ old('response') }}</textarea>
                    <input type="hidden" name="confirm" value="1">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2 transition duration-300 ease-in-out">ارسال پاسخ دوباره</button>
                    <a href="{{ route('seller.comments.index') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out mt-2">لغو</a>
                </form>
            </div>
        @endif

        <!-- Navigation -->
        <div class="flex justify-between mt-8 mb-4 text-sm">
            <form action="{{ route('seller.comments.index') }}" method="GET" class="flex items-center bg-white p-4 rounded shadow-md">
                <label for="food_id" class="mr-2 text-gray-700 font-semibold">فیلتر بر اساس غذا:</label>
                <select name="food_id" id="food_id" class="text-sm border-gray-300 rounded p-2 focus:ring focus:ring-green-200 focus:border-green-500">
                    <option value="">همه</option>
                    @foreach($restaurant->foods as $food)
                        <option value="{{ $food->id }}">{{ $food->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2 transition duration-300 ease-in-out">اعمال فیلتر</button>
            </form>
        </div>

        <!-- Comments Section -->
        <div class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
            <h2 class="text-xl mb-4 font-semibold text-gray-700">نظرات کاربران</h2>
            <div class="hidden lg:block overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            شماره نظر
                        </th>
                        <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            شماره سبد خرید
                        </th>
                        <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            نام غذاها
                        </th>
                        <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            تعداد
                        </th>
                        <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            مجموع هزینه
                        </th>
                        <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            نظر
                        </th>
                        <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            وضعیت
                        </th>
                        <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            تاریخ ارسال
                        </th>
                        <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            عملیات
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $comment->id }}
                            </td>
                            <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $comment->cart_id }}
                            </td>
                            <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm">
                                @foreach ($comment->cart->foods as $food)
                                    <div>{{ $food->name }}</div>
                                @endforeach
                            </td>
                            <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm">
                                @foreach ($comment->cart->foods as $food)
                                    <div>{{ $food->pivot->count }}</div>
                                @endforeach
                            </td>
                            <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ number_format($comment->cart->foods->sum(fn($food) => $food->price * $food->pivot->count), 2) }} تومان
                            </td>
                            <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $comment->comment }}
                            </td>
                            <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $comment->status }}
                            </td>
                            <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $comment->created_at->format('Y/m/d') }}
                            </td>
                            <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                @if($comment->status === 'pending' || $comment->status === 'request_deletion')
                                    <form action="{{ route('seller.comments.approve', $comment->id) }}" method="POST" class="flex items-center mb-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out w-full">
                                            تایید
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('seller.comments.deleteRequest', $comment->id) }}" method="POST" class="flex items-center flex-col mb-2">
                                    @csrf
                                    <textarea name="deletion_explanation" rows="1" class="w-full p-2 border rounded focus:ring focus:ring-red-200 focus:border-red-500 mb-2" placeholder="توضیحات حذف">{{ old('deletion_explanation') }}</textarea>
                                    @error('deletion_explanation')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out w-full">
                                        درخواست حذف
                                    </button>
                                </form>
                                <form action="{{ route('seller.comments.response', $comment->id) }}" method="POST" class="flex items-center flex-col">
                                    @csrf
                                    <textarea name="response" rows="1" class="w-full p-2 border rounded focus:ring focus:ring-blue-200 focus:border-blue-500 mb-2" placeholder="پاسخ">{{ old('response') }}</textarea>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out w-full">
                                        ارسال پاسخ
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="lg:hidden grid grid-cols-1 gap-6">
                @foreach ($comments as $comment)
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <div class="mb-2">
                            <span class="font-semibold">شماره نظر:</span> {{ $comment->id }}
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">شماره سبد خرید:</span> {{ $comment->cart_id }}
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">نام غذاها:</span>
                            @foreach ($comment->cart->foods as $food)
                                <div>{{ $food->name }}</div>
                            @endforeach
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">تعداد:</span>
                            @foreach ($comment->cart->foods as $food)
                                <div>{{ $food->pivot->count }}</div>
                            @endforeach
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">مجموع هزینه:</span> {{ number_format($comment->cart->foods->sum(fn($food) => $food->price * $food->pivot->count), 2) }} تومان
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">نظر:</span> {{ $comment->comment }}
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">وضعیت:</span> {{ $comment->status }}
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">تاریخ ارسال:</span> {{ $comment->created_at->format('Y/m/d') }}
                        </div>
                        <div class="text-center">
                            @if($comment->status === 'pending' || $comment->status === 'request_deletion')
                                <form action="{{ route('seller.comments.approve', $comment->id) }}" method="POST" class="flex items-center mb-2">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out w-full">
                                        تایید
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('seller.comments.deleteRequest', $comment->id) }}" method="POST" class="flex items-center flex-col mb-2">
                                @csrf
                                <textarea name="deletion_explanation" rows="1" class="w-full p-2 border rounded focus:ring focus:ring-red-200 focus:border-red-500 mb-2" placeholder="توضیحات حذف">{{ old('deletion_explanation') }}</textarea>
                                @error('deletion_explanation')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out w-full">
                                    درخواست حذف
                                </button>
                            </form>
                            <form action="{{ route('seller.comments.response', $comment->id) }}" method="POST" class="flex items-center flex-col">
                                @csrf
                                <textarea name="response" rows="1" class="w-full p-2 border rounded focus:ring focus:ring-blue-200 focus:border-blue-500 mb-2" placeholder="پاسخ">{{ old('response') }}</textarea>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out w-full">
                                    ارسال پاسخ
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
