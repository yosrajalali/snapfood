<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .custom-purple {
            background-color: rgb(128, 90, 213);
        }
    </style>
    @yield('head')
</head>
<body class="flex h-screen bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
<div x-data="setup()" :class="{ 'dark': isDark }" class="flex flex-row-reverse w-full">
    <!-- Sidebar -->
    <div class="fixed flex flex-col top-5 bottom-5 right-5 w-14 hover:w-64 md:w-64 custom-purple text-white transition-all duration-300 border-none z-10 sidebar rounded-lg">
        <div class="overflow-y-auto overflow-x-hidden flex flex-col justify-between flex-grow">
            <ul class="flex flex-col py-4 space-y-1">
                <li class="px-5 hidden md:block">
                    <div class="flex flex-row items-center h-8">
                        <div class="text-sm font-light tracking-wide text-gray-200 uppercase"></div>
                    </div>
                </li>
                <li>
                    <a href="{{ route('home') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-700 text-white hover:text-white border-r-4 border-transparent hover:border-purple-400 pr-0 md:pr-6 rounded-lg">
                        <span class="inline-flex justify-center items-center mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </span>
                        <span class="mr-2 text-sm tracking-wide truncate hidden md:inline">خانه</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('seller.recentOrders') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-700 text-white hover:text-white border-r-4 border-transparent hover:border-purple-400 pr-0 md:pr-6 rounded-lg">
                        <span class="inline-flex justify-center items-center mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm0 2c-2.21 0-4 1.79-4 4v4h8v-4c0-2.21-1.79-4-4-4z"></path>
                            </svg>
                        </span>
                        <span class="mr-2 text-sm tracking-wide truncate hidden md:inline">سفارشات جاری</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('seller.archived-orders') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-700 text-white hover:text-white border-r-4 border-transparent hover:border-purple-400 pr-0 md:pr-6 rounded-lg">
                        <span class="inline-flex justify-center items-center mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 002 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 002-2m14 0V7a2 2 0 00-2-2h-3.5a2 2 0 00-2-2h-3a2 2 0 00-2 2H7a2 2 0 00-2 2v4"></path>
                            </svg>
                        </span>
                        <span class="mr-2 text-sm tracking-wide truncate hidden md:inline">سفارشات آرشیو شده</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('seller.foods.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-700 text-white hover:text-white border-r-4 border-transparent hover:border-purple-400 pr-0 md:pr-6 rounded-lg">
                        <span class="inline-flex justify-center items-center mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6h18M3 12h18M3 18h18"></path>
                            </svg>
                        </span>
                        <span class="mr-2 text-sm tracking-wide truncate hidden md:inline">غذاها</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('seller.reports.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-700 text-white hover:text-white border-r-4 border-transparent hover:border-purple-400 pr-0 md:pr-6 rounded-lg">
                        <span class="inline-flex justify-center items-center mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v2a1 1 0 001 1h4a1 1 0 001-1v-2M4 10h16M4 6h16M4 14h16M4 18h16"></path>
                            </svg>
                        </span>
                        <span class="mr-2 text-sm tracking-wide truncate hidden md:inline">گزارش فروش</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('seller.comments.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-700 text-white hover:text-white border-r-4 border-transparent hover:border-purple-400 pr-0 md:pr-6 rounded-lg">
                        <span class="inline-flex justify-center items-center mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                        </span>
                        <span class="mr-2 text-sm tracking-wide truncate hidden md:inline">نظرات</span>
                    </a>
                </li>
                <li class="px-5 hidden md:block">
                    <div class="flex flex-row items-center mt-5 h-8">
                        <div class="text-sm font-light tracking-wide text-gray-200 uppercase">تنظیمات</div>
                    </div>
                </li>
                <li>
                    <a href="{{route('seller.restaurants.create')}}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-700 text-white hover:text-white border-r-4 border-transparent hover:border-purple-400 pr-0 md:pr-6 rounded-lg">
                        <span class="inline-flex justify-center items-center mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v16M20 4v16M4 4h16M4 20h16M9 9h6M9 12h6M9 15h6"></path>
                            </svg>
                        </span>
                        <span class="mr-2 text-sm tracking-wide truncate hidden md:inline">ثبت رستوران</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('seller.restaurant.settings.edit')}}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-700 text-white hover:text-white border-r-4 border-transparent hover:border-purple-400 pr-0 md:pr-6 rounded-lg">
                        <span class="inline-flex justify-center items-center mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </span>
                        <span class="mr-2 text-sm tracking-wide truncate hidden md:inline">تنظیمات</span>
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
@yield('scripts')
</body>
</html>
