<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل فروشنده</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-center">پنل فروشنده</h1>

    @if(session('success'))
        <div class="bg-green-200 border-l-4 border-green-500 text-green-700 p-4 mt-4 mb-8" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <p class="text-red-500 text-lg mt-4 mb-8 text-center">{{ $isRestaurantInfoComplete ?'' : 'لطفا اطلاعات رستوران خود را تکمیل کنید تا بتوانید به سایر بخش‌ها دسترسی داشته باشید.' }}</p>

    <div class="flex flex-wrap justify-center gap-5">

        <a href="{{ $isRestaurantInfoComplete ? route('seller.restaurant.settings.edit') : route('seller.restaurants.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{ $isRestaurantInfoComplete ? 'تنظیمات رستوران' : 'تکمیل اطلاعات رستوران' }}
        </a>

        <!-- Other Links (Conditionally Enabled) -->
        <a href="{{route('seller.dashboard')}}" class="{{ $isRestaurantInfoComplete ? 'bg-blue-500 hover:bg-blue-700' : 'bg-gray-300 cursor-not-allowed' }} text-white font-bold py-2 px-4 rounded">داشبورد</a>
        <a href="/" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">بازگشت به صفحه اصلی</a>

    </div>
</div>
</body>
</html>
