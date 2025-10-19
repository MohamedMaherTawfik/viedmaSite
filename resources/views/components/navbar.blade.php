<nav class="bg-white shadow-sm z-50 fixed top-0 left-0 w-full" dir="ltr">
    <div class="container mx-auto px-8 py-3 flex items-center justify-between">

        <!-- Left: Logo -->
        <div class="flex items-center gap-3">
            <img src="{{ asset('auth/rendered_page.png') }}" alt="Logo" class="h-24 w-40 mb-5">
        </div>

        <div class="hidden md:flex items-center gap-8 text-lg font-semibold" x-data="{ openMore: false }">
            <a href="/"
                class="text-2xl {{ request()->is('/') ? 'text-[#176b98]' : 'text-gray-700 hover:text-[#176b98]' }} transition">
                Home
            </a>

            <a href="{{ route('home') }}"
                class="text-2xl {{ request()->is('home/store') ? 'text-[#176b98]' : 'text-gray-700 hover:text-[#176b98]' }} transition">
                Store
            </a>

            <a href="{{ route('web.courses') }}"
                class="text-2xl {{ request()->is('courses/all') ? 'text-[#176b98]' : 'text-gray-700 hover:text-[#176b98]' }} transition">
                Courses
            </a>

            <a href="{{ route('schools') }}"
                class="text-2xl {{ request()->is('home/schools') ? 'text-[#176b98]' : 'text-gray-700 hover:text-[#176b98]' }} transition">
                Schools
            </a>

            <a href="{{ route('web.courses.enrolled') }}"
                class="text-2xl {{ request()->is('courses/enrolled/myCourses') ? 'text-[#176b98]' : 'text-gray-700 hover:text-[#176b98]' }} transition">
                My Courses
            </a>


            <!-- More Dropdown -->
            <div class="relative">
                <button @click="openMore = !openMore"
                    class="text-2xl text-gray-700 hover:text-[#176b98] transition flex items-center gap-1">
                    More
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform"
                        :class="openMore ? 'rotate-180' : 'rotate-0'" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="openMore" @click.away="openMore = false" x-transition
                    class="absolute left-0 mt-2 w-44 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                    <a href="{{ route('about') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-[#176b98] transition text-lg">
                        About Us
                    </a>
                    <a href="{{ route('contact') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-[#176b98] transition text-lg">
                        Contact
                    </a>
                </div>
            </div>
        </div>


        <!-- Right: Courses & Sign Up -->
        <div class="flex items-center gap-4">

            @if (Auth::check())
                <!-- زر السلة -->
                <a href="{{ route('cart') }}"
                    class="flex items-center gap-2 px-4 py-2 bg-[#176b98] text-white rounded-lg hover:bg-[#125a7d] transition">
                    <i class="fas fa-shopping-cart"></i>
                    <span>My Cart</span>
                </a>
            @endif


            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                    class="px-5 py-2 bg-[#176b98] text-white rounded-md hover:bg-[#115479] transition font-semibold flex items-center gap-2">
                    @if (Auth::check())
                        {{ Auth::user()->name }}
                    @else
                        Sign Up
                    @endif
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 mt-2 w-40 bg-white text-gray-700 rounded-md shadow-lg overflow-hidden z-50">
                    @guest
                        <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-100">Login</a>
                        <a href="{{ route('register') }}" class="block px-4 py-2 hover:bg-gray-100">Register</a>
                    @else
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                        </form>
                        <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Spacer to avoid content under navbar -->
<div class="mt-24">.</div>
