<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت تخفیف‌ها</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-center mb-6 flex-grow">مدیریت تخفیف‌ها</h1>
        <a href="{{ route('admin.dashboard') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            داشبورد مدیریت
        </a>
    </div>

    @if (session('success'))
        <div class="border border-t-0 border-green-400 rounded-b bg-green-100 px-4 py-3 mb-3 text-green-700">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <a href="{{ route('admin.discounts.create') }}" class="mb-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        ایجاد تخفیف جدید
    </a>
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <ul class="list-disc space-y-3 pl-5">
            @foreach ($discounts as $discount)
                <li class="flex justify-between items-center bg-gray-50 p-3 rounded-md">
                    <span class="font-medium">{{ $discount->name }} - {{ $discount->percentage }}%</span>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.discounts.edit', $discount) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                            ویرایش
                        </a>
                        <form action="{{ route('admin.discounts.destroy', $discount) }}" method="POST" onsubmit="return confirm('آیا از حذف این مورد اطمینان دارید؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                حذف
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="mt-4">
            {{ $discounts->links() }}
        </div>
    </div>
</div>
</body>
</html>
