<x-home-layout>

    {{-- ✅ رسائل النجاح والفشل --}}
    @if (session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-3 rounded bg-red-100 text-red-800 border border-red-300">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-3 rounded bg-yellow-100 text-yellow-800 border border-yellow-300">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex flex-col md:flex-row bg-gray-50 min-h-screen">
        <!-- 🕹️ الفئة الجانبية -->
        <div class="w-full md:w-64 bg-white border-r border-gray-200 p-6 shadow-md md:sticky md:top-0 md:h-screen">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('messages.title6') }}</h3>
            <ul class="space-y-2">
                @foreach ($gameCategorey as $category)
                    <li
                        class="px-3 py-2 rounded-md hover:bg-blue-50 cursor-pointer transition-colors duration-200 flex justify-between items-center">
                        <a href="{{ route('categorey.show', $category) }}" class="flex items-center">
                            <span class="text-gray-700">{{ $category->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- 🎮 المحتوى الرئيسي -->
        <div class="flex-1 p-6">
            <!-- 🎯 السلايدر العشوائي -->
            <div class="container mx-auto mb-10">
                <div
                    class="relative overflow-hidden rounded text-white h-96 flex items-center justify-center bg-gray-100">
                    <div class="swiper randomGameSwiper w-full max-w-6xl mx-auto px-4">
                        <div class="swiper-wrapper">
                            @foreach ($games->take(5) as $game)
                                @php
                                    $randomDiscount = rand(5, 70);
                                    $colors = [
                                        'from-blue-600/70 to-purple-600/70',
                                        'from-green-600/70 to-teal-600/70',
                                        'from-red-600/70 to-pink-600/70',
                                        'from-yellow-600/70 to-orange-600/70',
                                        'from-indigo-600/70 to-blue-600/70',
                                    ];
                                    $colorClass = $colors[$loop->index % count($colors)];
                                @endphp
                                <div class="swiper-slide">
                                    <div
                                        class="relative w-full h-96 rounded-2xl overflow-hidden shadow-2xl flex items-center transform transition-transform duration-500 hover:scale-[1.02]">
                                        <div class="absolute inset-0">
                                            <div class="w-full h-full bg-cover bg-center transition-transform duration-700 swiper-zoom-container"
                                                style="background-image: url('{{ $game->cover_image ? asset($game->cover_image) : 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg' }}')">
                                            </div>
                                        </div>

                                        <div class="relative z-10 flex items-center w-full px-8 space-x-8">
                                            <div class="w-1/3 flex justify-center">
                                                <div
                                                    class="relative w-48 h-64 rounded-xl overflow-hidden shadow-2xl transform transition-transform duration-500 hover:scale-105">
                                                    <img src="{{ $game->cover_image ? asset($game->cover_image) : 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg' }}"
                                                        alt="{{ $game->title }}" class="w-full h-full object-cover">
                                                    <div
                                                        class="absolute -top-2 -right-2 bg-red-500 text-white font-bold px-3 py-1 rounded-full shadow-lg transform rotate-12">
                                                        -{{ $randomDiscount }}%
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="w-2/3 space-y-4">
                                                <h2
                                                    class="text-4xl font-black tracking-tight bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">
                                                    {{ $game->title }}
                                                </h2>
                                                <p class="text-xl opacity-90 font-medium">
                                                    {{ __('messages.carousel.offer', ['discount' => $randomDiscount]) }}
                                                </p>
                                                <a href="{{ route('game.show', $game) }}"
                                                    class="mt-2 inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                                    {{ __('messages.carousel.button') }} →
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="swiper-button-next !w-12 !h-12 backdrop-blur-sm text-black transition-colors"></div>
                        <div class="swiper-button-prev !w-12 !h-12 backdrop-blur-sm text-black transition-colors"></div>

                        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 z-10">
                            <div class="swiper-pagination !relative !bottom-0"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 🧩 المكونات --}}
            <x-about-component />
            <x-courses-component />
            <x-why-us-component />
            <x-newsletter-component />
        </div>
    </div>

    <!-- SwiperJS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        const randomGameSwiper = new Swiper(".randomGameSwiper", {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
</x-home-layout>
