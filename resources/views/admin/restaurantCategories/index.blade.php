<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center pb-4">
        <h1 class="text-2xl font-bold">Restaurant Categories</h1>
        <a href="{{ route('restaurantcategories.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Category
        </a>
    </div>
    <table class="table-auto w-full">
        <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2 text-left">Name</th>
            <th class="px-4 py-2 text-left">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
            <tr>
                <td class="border px-4 py-2">{{ $category->category_name }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('restaurantcategories.edit', $category) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">Edit</a>
                    <form action="{{ route('restaurantcategories.destroy', $category) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
