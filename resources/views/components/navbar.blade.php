<?php
use App\Models\cartItems;
use App\Models\cart;
if (Auth::check()) {
    $cart = cart::where('user_id', Auth::id())->first();
    $cartitems = cartItems::where('cart_id', $cart->id)->count();
}
?>
<header class="bg-white shadow-sm z-50 relative">
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center gap-2">
            <img src="{{ asset('auth/rendered_page.png') }}" alt="Logo" class="h-16 w-36">
            <span class="font-bold text-lg text-[#79131d]"></span>
        </div>

        <!-- Navigation Menu (Desktop) -->
        <nav class="hidden md:flex items-center gap-6 font-semibold text-gray-800">
            <a href="/">الصفحه الرئيسيه</a>



            <a href="{{ route('game.all') }}">جميع الالعاب</a>

            <!-- More Dropdown -->
            <div x-data="{ openMore: false }" class="relative">
                <button @click="openMore = !openMore" class="flex items-center gap-1">
                    المزيد
                    <svg class="w-4 h-4 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="openMore" x-transition x-cloak
                    class="absolute top-full left-0 mt-2 w-40 bg-white border rounded-lg shadow-lg z-50">
                    <a href="{{ route('about') }}" class="block px-4 py-2 hover:text-[#79131d]">المزيد عنا</a>
                    <a href="{{ route('contact') }}" class="block px-4 py-2 hover:text-[#79131d]">تواصل معنا</a>
                </div>
            </div>
        </nav>

        <!-- Right Section -->
        <div class="flex items-center gap-4">
            @auth

                <div class="relative mr-4">
                    <a href="{{ route('cart') }}" class="flex items-center text-gray-700 hover:text-[#79131d]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.6 8H19m-12 0a2 2 0 104 0m4 0a2 2 0 104 0" />
                        </svg>
                        {{-- عدد العناصر في الكارت --}}
                        <span class="absolute -top-2 -right-2 bg-[#79131d] text-white text-xs rounded-full px-1">
                            {{ $cartitems }}
                        </span>
                    </a>
                </div>

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2">
                        <img src="https://media.istockphoto.com/id/1221380217/vector/avatar-photo-placeholder-icon-design.jpg?s=612x612&w=0&k=20&c=_MZwCujU2qoR0ICJVHrZ8ZB5zrJsx5FkgaW4PCgXeAs="
                            class="w-8 h-8 rounded-full object-cover">
                        <span class="text-sm font-bold">{{ Auth::user()->name }}</span>
                    </button>

                    <div x-show="open" x-transition x-cloak
                        class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg z-50">
                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm hover:text-[#79131d]">الملف
                            الشخصي</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:text-[#79131d]">
                                تسجيل خروج
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png"
                            class="w-8 h-8 rounded-full">
                        <div class="text-sm leading-tight text-left">
                            <div class="font-bold">زائر</div>
                            <div class="text-gray-500">تسجيل دخول / انشاء حساب</div>
                        </div>
                    </button>

                    <div x-show="open" x-transition x-cloak
                        class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg z-50">
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-sm hover:text-[#79131d]">تسجيل
                            الدخول
                        </a>

                        <a href="{{ route('register') }}" class="block px-4 py-2 text-sm hover:text-[#79131d]">
                            انشاء حساب
                        </a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</header>
