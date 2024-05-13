<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>افزودن غذای جدید</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#category_ids').select2({
                placeholder: "Select categories",
                allowClear: true
            });
        });
    </script>

</head>
<body class="bg-gray-200">
<div class="container mx-auto px-4 py-6">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-5">افزودن غذای جدید</h1>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-4xl mx-auto mb-3" role="alert">
            <strong class="font-bold">خطا!</strong>
            <span class="block sm:inline">لطفا خطاهای زیر را بررسی کنید.</span>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('seller.foods.store') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6 mb-4">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">نام غذا:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
        </div>

        <div class="mb-4">
            <label for="category_ids" class="block text-gray-700 text-sm font-bold mb-2">دسته‌بندی‌ها:</label>
            <select name="category_ids[]" id="category_ids" multiple class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ in_array($category->id, old('category_ids', [])) ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>



        <div class="mb-4">
            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">قیمت:</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
        </div>

        <div class="mb-4">
            <label for="ingredients" class="block text-gray-700 text-sm font-bold mb-2">مواد اولیه (اختیاری):</label>
            <textarea name="ingredients" id="ingredients" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('ingredients') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">عکس غذا (اختیاری):</label>
            <input type="file" name="image" id="image" class="block w-full text-sm text-gray-700 bg-white border border-gray-300 rounded cursor-pointer focus:outline-none">
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                ثبت غذا
            </button>
            <a href="{{ route('seller.foods.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">بازگشت به لیست</a>
        </div>
    </form>
</div>

</body>
</html>
