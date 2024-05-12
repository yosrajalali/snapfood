<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تنظیمات رستوران</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-6">
    <div class="max-w-lg mx-auto">
        <h1 class="text-3xl font-bold text-center mb-6">تنظیمات رستوران</h1>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-5" role="alert">
                <p class="font-bold">موفقیت آمیز</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <form action="{{ route('seller.restaurant.settings.update', $restaurant->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    نام رستوران
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" name="name" value="{{ old('name', $restaurant->name) }}" required>
                @error('name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                    نوع رستوران
                </label>
                <select class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="type" name="type">
                    <option value="فست فود" {{ old('type', $restaurant->type) == 'فست فود' ? 'selected' : '' }}>فست فود</option>
                    <option value="سنتی" {{ old('type', $restaurant->type) == 'سنتی' ? 'selected' : '' }}>سنتی</option>
                    <option value="کافه" {{ old('type', $restaurant->type) == 'کافه' ? 'selected' : '' }}>کافه</option>
                </select>
                @error('type')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                    آدرس
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="address" type="text" name="address" value="{{ old('address', $restaurant->address) }}" required>
                @error('address')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="bank_account_number">
                    شماره حساب بانکی
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="bank_account_number" type="text" name="bank_account_number" value="{{ old('bank_account_number', $restaurant->bank_account_number) }}">
                @error('bank_account_number')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="delivery_cost">
                    هزینه ارسال سفارشات
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="delivery_cost" type="text" name="delivery_cost" value="{{ old('delivery_cost', $restaurant->delivery_cost) }}">
                @error('delivery_cost')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                ساعات کاری رستوران
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach (['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday'] as $day)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ $day }}</label>
                            <input type="text" name="operational_hours[{{ $day }}][]" placeholder="09:00-12:00" value="{{ old('operational_hours.'.$day.'.0') }}" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <input type="text" name="operational_hours[{{ $day }}][]" placeholder="13:00-17:00" value="{{ old('operational_hours.'.$day.'.1') }}" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('operational_hours.' . $day . '.0')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                            @error('operational_hours.' . $day . '.1')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    تصویر رستوران
                </label>
                <input type="file" id="image" name="image" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('image')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            @if ($restaurant->image)
                <img src="{{ $restaurant->image }}" alt="Current Image" class="mt-2 w-20 h-20 mb-3 object-cover">
            @endif
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="is_open">
                    وضعیت رستوران
                </label>
                <select id="is_open" name="is_open" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="1" {{ old('is_open', $restaurant->is_open) ? 'selected' : '' }}>باز</option>
                    <option value="0" {{ !old('is_open', $restaurant->is_open) ? 'selected' : '' }}>بسته</option>
                </select>
            </div>


            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    به روز رسانی
                </button>
                <a href="{{ route('seller.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    بازگشت به داشبورد
                </a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
