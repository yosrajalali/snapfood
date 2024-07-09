@extends('layouts.seller')

@section('title', 'لیست غذاها')

@section('content')
    <div class="container mx-auto px-4 py-6 xs:w-3/5">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-4">لیست غذاها</h1>

        <!-- Session Message -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center py-4">
            <a href="{{ route('seller.foods.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">افزودن غذای جدید</a>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6 mb-4 overflow-x-auto">
            <div class="flex justify-between items-center py-4">
                <form method="GET" action="{{ route('seller.foods.index') }}" class="flex gap-2 flex-wrap">
                    <input type="text" name="name" placeholder="نام غذا" class="px-4 py-2 border rounded-lg focus:outline-none focus:shadow-outline text-gray-600 w-full xs:w-3/5 sm:w-full md:w-full lg:w-full xl:w-full" value="{{ request('name') }}">
                    <select name="category_id" class="px-4 py-2 border rounded-lg focus:outline-none focus:shadow-outline text-gray-600">
                        <option value="">انتخاب دسته‌بندی</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">فیلتر</button>
                </form>
            </div>

            <div class="hidden lg:block">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            تصویر غذا
                        </th>
                        <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            نام غذا
                        </th>
                        <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            نام رستوران
                        </th>
                        <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            دسته‌بندی
                        </th>
                        <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            قیمت
                        </th>
                        <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            تخفیف
                        </th>
                        <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            قیمت با تخفیف
                        </th>
                        <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            عملیات
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($foods as $food)
                        <tr>
                            <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <img src="{{ $food->image }}" alt="" class="w-20 h-20 rounded-full mx-auto">
                            </td>
                            <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $food->name }}
                            </td>
                            <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $food->restaurant->name }}
                            </td>
                            <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                @foreach ($food->categories as $category)
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                        {{ $category->category_name }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ number_format($food->price, 2) }} تومان
                            </td>
                            <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $food->discount ? $food->discount->percentage . '%' : 'بدون تخفیف' }}
                            </td>
                            <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{ $food->discount ? number_format($food->price * (1 - $food->discount->percentage / 100), 2) . ' تومان' : $food->price . ' تومان' }}
                            </td>
                            <td class="px-3 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <a href="{{ route('seller.foods.edit', $food) }}" class="text-blue-600 hover:text-blue-900">ویرایش</a>
                                <form action="{{ route('seller.foods.destroy', $food) }}" method="POST" onsubmit="return confirm('آیا مطمئن هستید؟');" class="inline-block">
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
            </div>

            <!-- Mobile Card View -->
            <div class="lg:hidden grid grid-cols-1 gap-6">
                @foreach ($foods as $food)
                    <div class="bg-white border border-gray-200 rounded-lg p-5 shadow-sm">
                        <div class="text-center mb-4">
                            <img src="{{ $food->image }}" alt="" class="w-20 h-20 rounded-full mx-auto">
                        </div>
                        <div class="text-center mb-2">
                            <strong class="block text-gray-600">نام غذا:</strong>
                            <span>{{ $food->name }}</span>
                        </div>
                        <div class="text-center mb-2">
                            <strong class="block text-gray-600">نام رستوران:</strong>
                            <span>{{ $food->restaurant->name }}</span>
                        </div>
                        <div class="text-center mb-2">
                            <strong class="block text-gray-600">دسته‌بندی:</strong>
                            @foreach ($food->categories as $category)
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                    {{ $category->category_name }}
                                </span>
                            @endforeach
                        </div>
                        <div class="text-center mb-2">
                            <strong class="block text-gray-600">قیمت:</strong>
                            <span>{{ number_format($food->price, 2) }} تومان</span>
                        </div>
                        <div class="text-center mb-2">
                            <strong class="block text-gray-600">تخفیف:</strong>
                            <span>{{ $food->discount ? $food->discount->percentage . '%' : 'بدون تخفیف' }}</span>
                        </div>
                        <div class="text-center mb-2">
                            <strong class="block text-gray-600">قیمت با تخفیف:</strong>
                            <span>{{ $food->discount ? number_format($food->price * (1 - $food->discount->percentage / 100), 2) . ' تومان' : $food->price . ' تومان' }}</span>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('seller.foods.edit', $food) }}" class="text-blue-600 hover:text-blue-900 block mb-2">ویرایش</a>
                            <form action="{{ route('seller.foods.destroy', $food) }}" method="POST" onsubmit="return confirm('آیا مطمئن هستید؟');" class="inline-block mb-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">حذف</button>
                            </form>
                            <a href="{{ route('seller.foods.toggle-food-party', $food) }}"
                               class="text-purple-600 hover:text-purple-900 block"
                               onclick="event.preventDefault(); document.getElementById('food-party-form-{{ $food->id }}').submit();">
                                {{ $food->food_party ? 'حذف از فود پارتی' : 'افزودن به فود پارتی' }}
                            </a>
                            <form id="food-party-form-{{ $food->id }}" action="{{ route('seller.foods.toggle-food-party', $food) }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="px-5 py-5">
                {{ $foods->links() }}
            </div>
        </div>
    </div>
@endsection
