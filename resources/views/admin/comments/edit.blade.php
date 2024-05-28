@extends('layouts.app')

@section('title', 'ویرایش نظر')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-2xl font-bold mb-6">ویرایش نظر</h2>
            <form action="{{ route('admin.comments.update', $comment->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="comment" class="block text-gray-700 text-sm font-bold mb-2">نظر:</label>
                    <textarea id="comment" name="comment" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('comment', $comment->comment) }}</textarea>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        ذخیره تغییرات
                    </button>
                    <a href="{{ route('admin.comments.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        بازگشت به لیست نظرات
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
