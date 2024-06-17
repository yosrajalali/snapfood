@extends('layouts.seller')

@section('title', 'ثبت رستوران')

@section('content')
    <div class=" min-h-screen flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-2xl font-bold mb-6 text-center">ثبت اطلاعات رستوران</h2>
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-5" role="alert">
                    <p class="font-bold">موفقیت آمیز</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-5" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('seller.restaurants.store') }}" method="POST">
                @csrf
                @if ($errors->any())
                    <div class="mb-4">
                        <div class="font-medium text-red-600">خطایی رخ داد!!</div>
                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">نام رستوران</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="نام رستوران" value="{{ old('name') }}">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="type">نوع رستوران</label>
                    <select id="type" name="type" class="shadow border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" onchange="document.getElementById('category_id').value = this.value">
                        <option value="">انتخاب کنید...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ (old('category_id') == $category->id) ? 'selected' : '' }}>{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" id="category_id" name="category_id" value="{{ old('category_id') }}">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone_number">شماره تماس</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone_number" name="phone_number" type="text" placeholder="شماره تماس" value="{{ old('phone_number') }}">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="address">آدرس</label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="address" name="address" placeholder="آدرس">{{ old('address') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="bank_account_number">شماره حساب</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="bank_account_number" name="bank_account_number" type="text" placeholder="شماره حساب" value="{{ old('bank_account_number') }}">
                </div>

                <div class="flex items-center justify-between mb-6">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">ثبت اطلاعات</button>
                </div>
            </form>
        </div>
    </div>
@endsection
