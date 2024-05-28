@extends('layouts.app')

@section('title', 'مدیریت نظرات')

@section('content')
    <div class="container mx-auto px-4 py-6">
        @if(session('success'))
            <div class="bg-green-100 border-r-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-r-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="flex justify-between items-center pb-4">
            <h1 class="text-3xl font-bold text-gray-800">مدیریت نظرات</h1>
        </div>

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                    شماره نظر
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                    شماره سبد خرید
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                    نظر
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                    تاریخ ارسال
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                    عملیات
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($comments as $comment)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $comment->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $comment->cart_id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $comment->comment }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $comment->created_at->format('Y/m/d') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.comments.edit', $comment->id) }}" class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 rounded-full px-3 py-1 font-bold transition duration-300 ease-in-out">
                            ویرایش
                        </a>
                        <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-green-600 hover:text-green-900 bg-green-100 hover:bg-green-200 rounded-full px-3 py-1 font-bold transition duration-300 ease-in-out">
                                تایید
                            </button>
                        </form>
                        <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="inline">
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

        <div class="py-4">
            {{ $comments->links() }}
        </div>
    </div>
@endsection
