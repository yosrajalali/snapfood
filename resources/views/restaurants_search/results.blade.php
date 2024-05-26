<!-- resources/views/restaurants_search_results.blade.php -->

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
        <div class="text-center text-red-500 font-semibold">{{ $message }}</div>
    @else
        <ul>
            @foreach ($nearbyRestaurants as $restaurant)
                <li class="mb-4">
                    <h2 class="text-2xl font-bold">{{ $restaurant->name }}</h2>
                    <p>{{ $restaurant->address }}</p>
                    <p>فاصله: {{ number_format($restaurant->distance, 2) }} کیلومتر</p>
                </li>
            @endforeach
        </ul>
    @endif
</div>
</body>
</html>
