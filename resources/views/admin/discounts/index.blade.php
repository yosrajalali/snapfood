@extends('layouts.app')

@section('title', 'مدیریت تخفیف‌ها')

@section('content')
    <div class="container mx-auto px-4 py-6">
        @if(session('success'))
            <div class="bg-green-100 border-r-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        <div class="flex flex-col lg:flex-row justify-between items-center pb-4 space-y-2 lg:space-y-0">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">مدیریت تخفیف‌ها</h1>
            <div class="flex flex-col md:flex-row items-center w-full lg:w-auto space-y-2 md:space-y-0 md:space-x-2">
                <form action="{{ route('admin.discounts.index') }}" method="GET" class="flex flex-grow md:flex-grow-0 w-full md:w-auto">
                    <input type="text" name="search" placeholder="جستجو..." class="px-3 py-2 border rounded-l-lg focus:outline-none focus:shadow-outline text-gray-600 w-full md:w-auto text-xs md:text-sm">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded-r-lg text-xs md:text-sm">
                        جستجو
                    </button>
                </form>
                <a href="{{ route('admin.discounts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out w-full md:w-auto text-xs md:text-sm">
                    ایجاد تخفیف جدید
                </a>
            </div>
        </div>

        <!-- Table for large screens -->
        <div class="hidden sm:block overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                <tr class="text-center">
                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase tracking-wider">نام تخفیف</th>
                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase tracking-wider">درصد تخفیف</th>
                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase tracking-wider">عملیات</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($discounts as $discount)
                    <tr class="text-center">
                        <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">{{ $discount->name }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">{{ $discount->percentage }}%</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.discounts.edit', $discount) }}" class="text-green-600 hover:text-green-900 bg-green-100 hover:bg-green-200 rounded-full px-3 py-1 font-bold transition duration-300 ease-in-out">
                                ویرایش
                            </a>
                            <form action="{{ route('admin.discounts.destroy', $discount) }}" method="POST" class="inline">
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
        </div>

        <!-- Cards for small screens -->
        <div class="sm:hidden">
            @foreach ($discounts as $discount)
                <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                    <div class="mb-2">
                        <strong class="block text-gray-600">نام تخفیف:</strong>
                        <span>{{ $discount->name }}</span>
                    </div>
                    <div class="mb-2">
                        <strong class="block text-gray-600">درصد تخفیف:</strong>
                        <span>{{ $discount->percentage }}%</span>
                    </div>
                    <div class="mb-2 flex justify-between">
                        <a href="{{ route('admin.discounts.edit', $discount) }}" class="text-green-600 hover:text-green-900 bg-green-100 hover:bg-green-200 rounded-full px-3 py-1 font-bold transition duration-300 ease-in-out">
                            ویرایش
                        </a>
                        <form action="{{ route('admin.discounts.destroy', $discount) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 rounded-full px-3 py-1 font-bold transition duration-300 ease-in-out" onclick="return confirm('آیا اطمینان دارید؟')">
                                حذف
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="py-4">
            {{ $discounts->appends(['search' => request('search')])->links() }}
        </div>
    </div>
@endsection
