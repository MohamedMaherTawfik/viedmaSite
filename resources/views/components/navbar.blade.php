@php
    use App\Models\cart;
    use App\Models\cartItems;
    if (auth()->check()) {
        $cart = cart::where('user_id', auth()->id())->first();
        $cartitems = $cart ? cartItems::where('cart_id', $cart->id)->count() : 0;
    } else {
        $cartitems = 0;
    }
@endphp

<nav class="bg-white shadow-sm z-50 fixed top-0 left-0 w-full" dir="ltr">
    <div class="container mx-auto px-6 py-1 flex items-center justify-between">

        <!-- Left: Logo -->
        <div class="flex items-center gap-2">
            <img src="{{ asset('auth/rendered_page.png') }}" alt="Logo" class="h-16 w-28">
        </div>

        <!-- Center: Links -->
        <div class="hidden md:flex items-center gap-6 text-[15px] font-semibold" x-data="{ openMore: false }">
            <a href="/"
                class="{{ request()->is('/') ? 'text-[#176b98]' : 'text-gray-700 hover:text-[#176b98]' }} transition">
                Home
            </a>

            <a href="{{ route('home') }}"
                class="{{ request()->is('home/store') ? 'text-[#176b98]' : 'text-gray-700 hover:text-[#176b98]' }} transition">
                Store
            </a>

            <a href="{{ route('web.courses') }}"
                class="{{ request()->is('courses/all') ? 'text-[#176b98]' : 'text-gray-700 hover:text-[#176b98]' }} transition">
                Courses
            </a>

            <a href="{{ route('schools') }}"
                class="{{ request()->is('home/schools') ? 'text-[#176b98]' : 'text-gray-700 hover:text-[#176b98]' }} transition">
                Schools
            </a>

            <a href="{{ route('web.courses.enrolled') }}"
                class="{{ request()->is('courses/enrolled/myCourses') ? 'text-[#176b98]' : 'text-gray-700 hover:text-[#176b98]' }} transition">
                My Courses
            </a>

            <div class="relative">
                <button @click="openMore = !openMore"
                    class="text-gray-700 hover:text-[#176b98] transition flex items-center gap-1">
                    More
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform"
                        :class="openMore ? 'rotate-180' : 'rotate-0'" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="openMore" @click.away="openMore = false" x-transition
                    class="absolute left-0 mt-2 w-40 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                    <a href="{{ route('about') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-[#176b98] transition">
                        About Us
                    </a>
                    <a href="{{ route('contact') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-[#176b98] transition">
                        Contact
                    </a>
                </div>
            </div>

            <!-- Register button visible if guest -->
            @guest
                <a href="{{ route('register') }}" class="text-gray-700 hover:text-[#176b98] transition font-semibold">
                    Register
                </a>
            @endguest
        </div>

        <!-- Right: Cart + Login/Profile -->
        <div class="flex items-center gap-3">

            @auth
                <a href="{{ route('cart') }}" class="relative text-[#176b98] hover:text-[#125a7d] transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 2.25h1.5l1.5 13.5h12l1.5-9h-13.5M7.5 20.25a.75.75 0 100-1.5.75.75 0 000 1.5zm9 0a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                    </svg>
                    <span class="absolute -top-1 -right-1 bg-red-600 text-white text-[11px] font-bold rounded-full px-1.5">
                        {{ $cartitems }}
                    </span>
                </a>
            @endauth

            <!-- Auth Dropdown / Login -->
            @auth
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="px-3 py-1.5 bg-[#176b98] text-white rounded-md hover:bg-[#115479] transition font-semibold flex items-center gap-2 text-[15px]">
                        {{ Auth::user()->name }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-2 w-40 bg-white text-gray-700 rounded-md shadow-lg overflow-hidden z-50">
                        <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="px-4 py-1.5 bg-[#176b98] text-white rounded-md hover:bg-[#115479] transition font-semibold text-[15px]">
                    Login
                </a>
            @endauth
        </div>
    </div>
</nav>

<!-- Spacer -->
<div class="mt-20"></div>
