<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نتایج جستجوی رستوران‌ها</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200">
<div class="container mx-auto px-4 py-6">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-5">رستوران‌های نزدیک</h1>

    @if ($message)
        <div class="text-center text-red-500 font-semibold mb-5">{{ $message }}</div>
    @else
        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($nearbyRestaurants as $restaurant)
                <li class="bg-white rounded-lg shadow-md p-6 flex">
                    @if ($restaurant->image)
                        <img src="{{ $restaurant->image }}" alt="{{ $restaurant->name }}" class="w-32 h-32 rounded-full object-cover mr-4">
                    @else
                        <div class="w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center mr-4">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    @endif
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $restaurant->name }}</h2>
                        <p class="text-gray-600 mb-1">{{ $restaurant->address }}</p>
                        <p class="text-gray-600 mb-1">دسته‌بندی: {{ $restaurant->category->category_name }}</p>
                        <p class="text-gray-600">فاصله: {{ number_format($restaurant->distance, 2) }} کیلومتر</p>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    <div class="text-center mt-6">
        <a href="{{ route('home') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">بازگشت به صفحه اصلی</a>
    </div>
</div>
</body>
</html>
