<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد فروشنده</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200">
<div class="container mx-auto px-4 py-6">
    <h1 class="text-4xl font-bold text-center text-gray-800">نظرات کاربران</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-5" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Dashboard Navigation -->
    <div class="flex justify-around mt-8 mb-4 text-sm">
        <a href="{{route('seller.dashboard')}}" class="bg-pink-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">سفارشات کنونی</a>
        <a href="{{route('seller.archived-orders')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">سفارشات آرشیو شده</a>
        <a href="{{route('seller.foods.index')}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">غذاها</a>
        <a href="#" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">گزارش فروش</a>
        <a href="{{route('seller.comments.index')}}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">نظرات</a>
        <a href="{{ route('seller.index') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">بازگشت به صفحه اصلی</a>

    </div>

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
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        شماره نظر
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        شماره سبد خرید
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        نام غذاها
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        تعداد
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        مجموع هزینه
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        نظر
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        وضعیت
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        تاریخ ارسال
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                        عملیات
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            {{ $comment->id }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            {{ $comment->cart_id }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            @foreach ($comment->cart->foods as $food)
                                <div>{{ $food->name }}</div>
                            @endforeach
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            @foreach ($comment->cart->foods as $food)
                                <div>{{ $food->pivot->count }}</div>
                            @endforeach
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            {{ number_format($comment->cart->foods->sum(fn($food) => $food->price * $food->pivot->count), 2) }} تومان
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            {{ $comment->comment }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            {{ $comment->status }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            {{ $comment->created_at->format('Y/m/d') }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            @if($comment->status === 'pending')
                                <form action="{{ route('seller.comments.approve', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                                        تایید
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('seller.comments.deleteRequest', $comment->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                                    درخواست حذف
                                </button>
                            </form>
                            <form action="{{ route('seller.comments.reply', $comment->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('PATCH')
                                <textarea name="reply" rows="2" class="w-full mt-2 p-2 border rounded focus:ring focus:ring-blue-200 focus:border-blue-500"></textarea>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out mt-2">
                                    ارسال پاسخ
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="px-5 py-5">
                {{ $comments->links() }}
            </div>
        </div>
    </div>
</div>
</body>
</html>
