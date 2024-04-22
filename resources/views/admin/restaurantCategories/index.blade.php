<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>دسته‌بندی‌های رستوران‌ها</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <!-- Consider using a localized version of Tailwind CSS for RTL if available -->
</head>
<body class="bg-gray-50">
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center pb-4">
        <h1 class="text-3xl font-bold text-gray-800">دسته‌بندی‌های رستوران‌ها</h1>
        <div>
            <form action="{{ route('admin.restaurantCategories.index') }}" method="GET" class="inline">
                <input type="text" name="search" placeholder="جستجو..." class="px-4 py-2 border rounded-l-lg focus:outline-none focus:shadow-outline text-gray-600" value="{{ request('search') }}">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-lg">
                    جستجو
                </button>
            </form>
            <a href="{{ route('admin.restaurantCategories.create') }}" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                افزودن دسته‌بندی
            </a>
        </div>
    </div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
        <tr>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                نام
            </th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                عملیات
            </th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($categories as $category)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $category->category_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('admin.restaurantCategories.edit', $category) }}" class="text-green-600 hover:text-green-900 bg-green-100 hover:bg-green-200 rounded-full px-3 py-1 font-bold transition duration-300 ease-in-out">
                        ویرایش
                    </a>
                    <form action="{{ route('admin.restaurantCategories.destroy', $category) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 rounded-full px-3 py-1 font-bold transition duration-300 ease-in-out" onclick="return confirm('آیا اطمینان دارید؟')">
                            حذف
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="" class=" hover:text-gray-600 text-blue-500 font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
        بازگشت به داشبورد
    </a>
    <div class="py-4">
        {{$categories->appends(['search' => request('search')])->links()}}
    </div>

</div>
</body>
</html>
