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
    <p class="text-red-500 text-lg mt-4 mb-8 text-center">لطفا اطلاعات رستوران خود را تکمیل کنید تا بتوانید به سایر بخش‌ها دسترسی داشته باشید.</p>

    <div class="flex flex-wrap justify-center gap-5">
        <a href="" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">تکمیل اطلاعات رستوران</a>

        <!-- Other Links (Conditionally Disabled) -->
        @php
            $isRestaurantInfoComplete = false; // This should be determined based on your application logic
        @endphp

        <a href="#" class="{{ $isRestaurantInfoComplete ? 'bg-blue-500 hover:bg-blue-700' : 'bg-gray-300' }} text-white font-bold py-2 px-4 rounded cursor-not-allowed" onclick="return false;">داشبورد</a>
        <a href="#" class="{{ $isRestaurantInfoComplete ? 'bg-blue-500 hover:bg-blue-700' : 'bg-gray-300' }} text-white font-bold py-2 px-4 rounded cursor-not-allowed" onclick="return false;">غذاها</a>
        <a href="#" class="{{ $isRestaurantInfoComplete ? 'bg-blue-500 hover:bg-blue-700' : 'bg-gray-300' }} text-white font-bold py-2 px-4 rounded cursor-not-allowed" onclick="return false;">وضعیت سفارش‌ها</a>
        <a href="#" class="{{ $isRestaurantInfoComplete ? 'bg-blue-500 hover:bg-blue-700' : 'bg-gray-300' }} text-white font-bold py-2 px-4 rounded cursor-not-allowed" onclick="return false;">بررسی‌ها</a>
        <a href="#" class="{{ $isRestaurantInfoComplete ? 'bg-blue-500 hover:bg-blue-700' : 'bg-gray-300' }} text-white font-bold py-2 px-4 rounded cursor-not-allowed" onclick="return false;">گزارش‌ها</a>
        <a href="#" class="{{ $isRestaurantInfoComplete ? 'bg-blue-500 hover:bg-blue-700' : 'bg-gray-300' }} text-white font-bold py-2 px-4 rounded cursor-not-allowed" onclick="return false;">تنظیمات رستوران</a>
    </div>
</div>
</body>
</html>
