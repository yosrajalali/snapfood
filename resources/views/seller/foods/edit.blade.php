<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش غذا</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200">
<div class="container mx-auto px-4 py-6">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 mb-4">
        <h1 class="text-4xl font-bold text-center text-gray-800">ویرایش غذا</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">خطا!</strong>
                <span class="block sm:inline">لطفاً خطاهای زیر را بررسی کنید.</span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('seller.foods.update', $food->id) }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    نام غذا
                </label>
                <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('name', $food->name) }}">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">
                    دسته‌بندی
                </label>
                <select name="category_id" id="category_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $food->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                    قیمت
                </label>
                <input type="text" name="price" id="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('price', $food->price) }}">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="ingredients">
                    مواد اولیه
                </label>
                <input type="text" name="ingredients" id="ingredients" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('ingredients', $food->ingredients) }}">
            </div>
{{--            <div class="mb-4">--}}
{{--                <label class="block text-gray-700 text-sm font-bold mb-2" for="ingredients">--}}
{{--                    تخفیف--}}
{{--                </label>--}}
{{--                <input type="number" name="discount" value="{{ old('discount', $food->discount) }}" placeholder="تخفیف (%)" class="form-control" min="0" max="100">--}}

{{--            </div>--}}

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="discount_id">
                    تخفیف
                </label>
                <select class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="discount_id" name="discount_id">
                    <option value="">انتخاب تخفیف</option>
                    @foreach ($discounts as $discount)
                        <option value="{{ $discount->id }}" {{ old('discount_id', $food->discount_id) == $discount->id ? 'selected' : '' }}>
                            {{ $discount->name }} - {{ $discount->percentage }}%
                        </option>
                    @endforeach
                </select>
                @error('discount_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>



            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    عکس
                </label>
                <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @if ($food->image)
                    <img src="{{ $food->image }}" alt="Current Image" class="mt-2 w-24 h-24 object-cover">
                @endif
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                    به روز رسانی
                </button>
                <a href="{{ route('seller.foods.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    بازگشت به لیست
                </a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
