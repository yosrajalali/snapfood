<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ایجاد تخفیف جدید</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-center mb-6">ایجاد تخفیف جدید</h1>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-5" role="alert">
            <p class="font-bold">موفقیت</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <form action="{{ route('admin.discounts.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">نام تخفیف</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @error('name')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="percentage" class="block text-gray-700 text-sm font-bold mb-2">درصد تخفیف</label>
            <input type="number" name="percentage" id="percentage" value="{{ old('percentage') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @error('percentage')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                ایجاد
            </button>
            <a href="{{ route('admin.discounts.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                بازگشت به لیست تخفیف‌ها
            </a>
        </div>
    </form>
</div>
</body>
</html>
