<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet">
    <title>@yield('title', 'Dashboard')</title>
    <style>
        .custom-purple {
            background-color: rgb(128, 90, 213);
        }
    </style>
</head>
<body class="flex h-screen bg-white dark:bg-gray-700 text-black dark:text-white">
<div x-data="setup()" :class="{ 'dark': isDark }" class="flex flex-row-reverse w-full">
    <!-- Sidebar -->
    <div class="fixed flex flex-col top-5 bottom-5 right-5 w-14 hover:w-64 md:w-64 custom-purple text-white transition-all duration-300 border-none z-10 sidebar rounded-lg">
        <div class="overflow-y-auto overflow-x-hidden flex flex-col justify-between flex-grow">
            <ul class="flex flex-col py-4 space-y-1 flex-grow">
                <li class="px-5 hidden md:block">
                    <div class="flex flex-row items-center h-8">
                        <div class="text-sm font-light tracking-wide text-gray-200 uppercase"></div>
                    </div>
                </li>
                <li>
                    <a href="{{ route('home') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-700 text-white hover:text-white border-r-4 border-transparent hover:border-purple-400 pr-6 rounded-lg">
                        <span class="inline-flex justify-center items-center mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </span>
                        <span class="mr-2 text-sm tracking-wide truncate">خانه</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.foodCategories.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-700 text-white hover:text-white border-r-4 border-transparent hover:border-purple-400 pr-6 rounded-lg">
                        <span class="inline-flex justify-center items-center mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 11h18M3 15h18M3 19h18"></path>
                            </svg>
                        </span>
                        <span class="mr-2 text-sm tracking-wide truncate">دسته بندی غذاها</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.restaurantCategories.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-700 text-white hover:text-white border-r-4 border-transparent hover:border-purple-400 pr-6 rounded-lg">
                        <span class="inline-flex justify-center items-center mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m-4 4h10"></path>
                            </svg>
                        </span>
                        <span class="mr-2 text-sm tracking-wide truncate">دسته بندی رستورانها</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.discounts.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-700 text-white hover:text-white border-r-4 border-transparent hover:border-purple-400 pr-6 rounded-lg">
                        <span class="inline-flex justify-center items-center mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </span>
                        <span class="mr-2 text-sm tracking-wide truncate">تخفیف ها</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.comments.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-700 text-white hover:text-white border-r-4 border-transparent hover:border-purple-400 pr-6 rounded-lg">
                        <span class="inline-flex justify-center items-center mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11h4m4 0h-4m4-4H8m4 8h4m0 4H8m4-8h4"></path>
                            </svg>
                        </span>
                        <span class="mr-2 text-sm tracking-wide truncate">نظرات</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- ./Sidebar -->
    <!-- Content -->
    <div class="flex-1 flex flex-col mr-14 md:mr-64">
        <main class="flex-grow p-6">
            @yield('content')
        </main>
    </div>
    <!-- ./Content -->
</div>

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
<script src="{{ asset('js/admin/dashboard.js') }}"></script>
</body>
</html>
