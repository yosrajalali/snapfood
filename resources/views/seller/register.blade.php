<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام فروشندگان</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body, input, button {
            font-family: 'Vazir', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-200 flex items-center justify-center h-screen">
<div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
    <h1 class="text-2xl font-bold text-center mb-6">ثبت نام فروشندگان</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">خطا!</strong>
            <span class="block sm:inline">لطفا خطاهای زیر را بررسی کنید.</span>
            <ul class="mt-3 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('seller.register') }}">
        @csrf
        <div class="mb-4">
            <input type="text" name="name" placeholder="نام کامل" class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value="{{ old('name') }}" >
        </div>
        <div class="mb-4">
            <input type="email" name="email" placeholder="ایمیل" class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value="{{ old('email') }}" >
        </div>
        <div class="mb-4">
            <input type="text" name="phone_number" placeholder="شماره تلفن" class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value="{{ old('phone_number') }}" >
        </div>
        <div class="mb-4">
            <input type="password" name="password" placeholder="رمز عبور" class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
        </div>
        <div class="mb-6">
            <input type="password" name="password_confirmation" placeholder="تأیید رمز عبور" class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">ثبت نام</button>
    </form>
</div>
</body>
</html>
