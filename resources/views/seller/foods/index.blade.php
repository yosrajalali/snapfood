<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لیست غذاها</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200">
<div class="container mx-auto px-4 py-6">
    <h1 class="text-4xl font-bold text-center text-gray-800">لیست غذاها</h1>

    <!-- Dashboard Navigation -->
    <div class="flex justify-around mt-8 mb-4 text-sm">
        <a href="{{route('seller.dashboard')}}" class="bg-pink-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">سفارشات کنونی</a>
        <a href="{{route('seller.archived-orders')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">سفارشات آرشیو شده</a>
        <a href="{{route('seller.foods.index')}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">غذاها</a>
        <a href="#" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">گزارش فروش</a>
        <a href="#" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">تنظیمات رستوران</a>
        <a href="{{ route('seller.index') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">بازگشت به صفحه اصلی</a>

    </div>

    <!-- Session Message -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center py-4">
        <a href="{{ route('seller.foods.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">افزودن غذای جدید</a>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6 mb-4">
        <div class="flex justify-between items-center py-4">
            <form method="GET" action="{{ route('seller.foods.index') }}" class="flex gap-2">
                <input type="text" name="name" placeholder="نام غذا" class="px-4 py-2 border rounded-lg focus:outline-none focus:shadow-outline text-gray-600" value="{{ request('name') }}">
                <select name="category_id" class="px-4 py-2 border rounded-lg focus:outline-none focus:shadow-outline text-gray-600">
                    <option value="">انتخاب دسته‌بندی</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">فیلتر</button>
            </form>
{{--            <a href="{{ route('seller.foods.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">افزودن غذای جدید</a>--}}
        </div>

        <table class="min-w-full leading-normal">
            <thead>
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100  text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    تصویر غذا
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100  text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    نام غذا
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100  text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    نام رستوران
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100  text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    دسته‌بندی
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100  text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    قیمت
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100  text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    تخفیف
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100  text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    قیمت با تخفیف
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100  text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    عملیات
                </th>
            </tr>
            </thead>
            <tbody>

            @foreach ($foods as $food)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        <img src="{{$food->image }}" alt="" class="w-20 h-20 rounded-full mx-auto">
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        {{ $food->name }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        {{ $food->restaurant->name }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        {{ $food->category->category_name }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        {{ number_format($food->price, 2) }} تومان
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        {{ $food->discount }} درصد
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        {{ number_format($food->price * (1 - $food->discount / 100),2) }} تومان
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        <a href="{{ route('seller.foods.edit', $food) }}" class="text-blue-600 hover:text-blue-900">ویرایش</a>
                        <form action="{{ route('seller.foods.destroy', $food) }}" method="POST" onsubmit="return confirm('آیا مطمئن هستید؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">حذف</button>
                        </form>

                        <a href="{{ route('seller.foods.toggle-food-party', $food) }}"
                           class="text-purple-600 hover:text-purple-900"
                           onclick="event.preventDefault(); document.getElementById('food-party-form-{{ $food->id }}').submit();">
                            {{ $food->food_party ? 'حذف از فود پارتی' : 'افزودن به فود پارتی' }}
                        </a>

                        <form id="food-party-form-{{ $food->id }}" action="{{ route('seller.foods.toggle-food-party', $food) }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </td>

                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="px-5 py-5">
            {{ $foods->links() }}
        </div>
    </div>
</div>
</body>
</html>
