<nav class="bg-white shadow-sm z-50 fixed top-0 left-0 w-full" dir="ltr" x-data="{ openMenu: false }">

    <!-- Top Navbar -->
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">

        <!-- Left: Menu Button -->
        <button @click="openMenu = !openMenu"
            class="text-gray-700 hover:text-gray-900 focus:outline-none flex items-center gap-2">
            <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span class="text-base font-medium">MENU</span>
        </button>

        <!-- Center: Logo & Brand -->
        <div class="absolute left-1/2 transform -translate-x-1/2 flex items-center gap-4">
            <img src="{{ asset('auth/rendered_page.png') }}" alt="Logo" class="h-24 w-48">
            <div class="hidden md:block">
            </div>
        </div>

        <!-- Right Section (Desktop Only) -->
        <div class="hidden md:flex items-center gap-5">
            @if (request()->is('home/*'))
                <a href="{{ route('games.all') }}"
                    class="flex items-center gap-2 text-gray-700 hover:text-[#176b98] transition text-base font-medium">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span>Games</span>
                </a>
            @endif

            <!-- Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <!-- Button -->
                <button @click="open = !open"
                    class="px-5 py-3 bg-[#176b98] text-white rounded-md hover:bg-[#115479FF] transition text-base font-semibold flex items-center gap-2">
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

                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 mt-2 w-40 bg-white text-gray-700 rounded-md shadow-lg overflow-hidden z-50">

                    @guest
                        <!-- If not logged in -->
                        <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-100">Login</a>
                        <a href="{{ route('register') }}" class="block px-4 py-2 hover:bg-gray-100">Register</a>
                    @else
                        <!-- If logged in -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                        </form>
                    @endguest

                </div>
            </div>

        </div>
    </div>

    <!-- Promo Banner -->
    <div class="bg-[#176b98] text-white text-sm text-center py-2 text-base font-medium">
        Don't miss out! Enrol by September 30th and save £250! Need advice?
        <a href="{{ route('contact') }}" class="underline text-[#e4ce96] hover:text-[#E4C474FF]">Book a call with our
            team</a>
    </div>

    <!-- Sidebar Menu (Overlay) -->
    <div x-show="openMenu" x-transition x-cloak class="fixed inset-0 z-50 flex">

        <!-- Overlay Background -->
        <div @click="openMenu = false" class="flex-1 bg-black bg-opacity-50"></div>

        <!-- Sidebar Panel -->
        <div class="fixed top-0 left-0 h-full w-[480px] md:w-[700px] max-w-full md:max-w-[700px] bg-[#176b98] text-white shadow-lg flex flex-col transform transition-transform duration-300"
            x-show="openMenu" x-transition:enter="transform -translate-x-full"
            x-transition:enter-end="transform translate-x-0" x-transition:leave="transform translate-x-0"
            x-transition:leave-end="transform -translate-x-full">

            <!-- Close Button -->
            <div class="flex items-center justify-between p-4 border-b border-gray-700">
                <button @click="openMenu = false" class="flex items-center gap-2 text-white hover:text-gray-200">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span class="font-semibold">CLOSE</span>
                </button>
            </div>

            <!-- Body: Split into Links + Images -->
            <div class="flex flex-grow">

                <!-- Left: Menu Links (2/3) -->
                <div class="w-1/2 p-6 flex flex-col justify-start space-y-6">
                    <a href="{{ route('home') }}"
                        class="text-2xl font-semibold text-[#e4ce96] hover:text-[#C7AE70FF]  transition">Home</a>

                    <a href="{{ route('about') }}"
                        class="text-2xl font-semibold text-[#e4ce96] hover:text-[#C7AE70FF]  transition">About Us</a>
                    <a href="{{ route('contact') }}"
                        class="text-2xl font-semibold text-[#e4ce96] hover:text-[#C7AE70FF]  transition">Contact</a>
                    <a href="#"
                        class="text-2xl font-semibold text-[#e4ce96] hover:text-[#C7AE70FF]  transition">FAQ</a>
                    <a href="#"
                        class="text-2xl font-semibold text-[#e4ce96] hover:text-[#C7AE70FF]  transition">Blog</a>

                    <a href="#"
                        class="text-2xl font-semibold text-[#e4ce96] hover:text-[#C7AE70FF]  transition">Student
                        Reviews</a>
                    @if (Auth::check())
                        <a href="{{ route('profile') }}"
                            class="text-2xl font-semibold text-[#e4ce96] hover:text-[#C7AE70FF]  transition"> profile
                        </a>
                        <a href="{{ route('logout') }}"
                            class="text-2xl font-semibold text-[#e4ce96] hover:text-[#C7AE70FF]  transition"> logout
                        </a>
                    @endif

                </div>

                <!-- Right: Images Section (1/3) -->
                <div class="w-1/2 flex flex-col mr-2">

                    <!-- Image 1 -->
                    <a href="{{ route('home') }}"
                        class="flex-1 bg-cover bg-center bg-no-repeat relative mt-3 border-4 border-[#FEBE35] rounded-3xl block transform transition duration-300 hover:scale-105"
                        style="background-image: url({{ asset('images/store.png') }})">
                        <div
                            class="absolute bottom-3 left-3 bg-[#176b98] bg-opacity-75 text-[#FEBE35] font-bold px-3 py-1 rounded text-sm font-medium">
                            Games Zone
                        </div>
                    </a>

                    <!-- Image 2 -->
                    <a href="#"
                        class="flex-1 bg-cover bg-center bg-no-repeat relative mt-3 border-4 border-[#FEBE35] rounded-3xl block transform transition duration-300 hover:scale-105"
                        style="background-image: url({{ asset('images/courses.png') }})">
                        <div
                            class="absolute bottom-3 left-3 bg-[#176b98] bg-opacity-75 text-[#FEBE35] font-bold px-3 py-1 rounded text-sm font-medium">
                            Courses Zone
                        </div>
                    </a>

                    <!-- Image 3 -->
                    <a href="{{ route('teacher.register') }}"
                        class="flex-1 bg-cover bg-center bg-no-repeat relative mt-3 border-4 border-[#FEBE35] rounded-3xl block transform transition duration-300 hover:scale-105"
                        style="background-image: url('https://images.pexels.com/photos/159844/cellular-education-classroom-159844.jpeg?cs=srgb&dl=pexels-pixabay-159844.jpg&fm=jpg')">
                        <div
                            class="absolute bottom-3 left-3 bg-[#176b98] bg-opacity-75 text-[#FEBE35] font-bold px-3 py-1 rounded text-sm font-medium">
                            Teacher Zone
                        </div>
                    </a>



                </div>

            </div>

        </div>
    </div>
</nav>
<div class="mt-10">.</div>
<div class="mt-6">.</div>
