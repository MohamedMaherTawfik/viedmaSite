<x-home-layout>
    <div class="min-h-screen bg-gradient-to-b from-gray-100 to-gray-200 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Breadcrumbs -->
            <nav class="mb-6">
                <ol class="flex items-center space-x-2 text-sm text-gray-600">
                    <li><a href="/" class="hover:text-dark-blue transition">الرئيسية</a></li>
                    <li class="text-gray-400">/</li>
                    <li><a href="{{ route('game.all') }}" class="hover:text-dark-blue transition">الألعاب</a></li>
                    <li class="text-gray-400">/</li>
                    <li class="text-dark-blue font-medium">{{ $game->title }}</li>
                </ol>
            </nav>
            {{-- رسالة النجاح --}}
            @if (session('success'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-300">
                    {{ session('success') }}
                </div>
            @endif

            {{-- رسالة الفشل --}}
            @if (session('error'))
                <div class="mb-4 p-3 rounded bg-red-100 text-red-800 border border-red-300">
                    {{ session('error') }}
                </div>
            @endif

            {{-- عرض الأخطاء من الفاليديشن --}}
            @if ($errors->any())
                <div class="mb-4 p-3 rounded bg-yellow-100 text-yellow-800 border border-yellow-300">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Left Column - Game Media -->
                <div class="lg:w-2/3">
                    <!-- Main Game Cover -->
                    <div class="relative rounded-xl overflow-hidden shadow-lg mb-6">
                        <img src="{{ asset('storage/' . $game->cover_image) }}" alt="{{ $game->title }}"
                            class="w-full h-80 md:h-96 object-cover transition-transform duration-500 hover:scale-105">

                        <!-- Badges -->
                        <div class="absolute top-4 left-4 flex space-x-2 rtl:space-x-reverse">
                            <span class="bg-gold text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                                {{ ucfirst($game->platform ?? 'غير متوفر') }}
                            </span>
                            @if ($game->is_new)
                                <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                                    جديد
                                </span>
                            @endif
                        </div>

                        <div
                            class="absolute bottom-4 right-4 bg-dark-blue text-white text-sm px-3 py-1 rounded-md bg-opacity-90">
                            {{ date('d M Y', strtotime($game->release_date)) }}
                        </div>
                    </div>

                    <!-- Game Gallery (if available) -->
                    <div class="grid grid-cols-3 gap-3 mb-8">
                        @for ($i = 0; $i < 3; $i++)
                            <div class="rounded-lg overflow-hidden shadow-md cursor-pointer hover:shadow-lg transition">
                                <img src="{{ $game->cover_image }}" alt="Game screenshot {{ $i + 1 }}"
                                    class="w-full h-24 object-cover">
                            </div>
                        @endfor
                    </div>

                    <!-- Game Description -->
                    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">وصف اللعبة</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $game->description }}</p>
                    </div>

                </div>

                <!-- Right Column - Game Info & Purchase -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-xl shadow-lg sticky top-4 p-6">
                        <!-- Title & Rating -->
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $game->title }}</h1>
                        <p class="text-lg text-gray-600 mb-4">
                            <span class="font-medium">المنشئ:</span> {{ $game->developer_name }}
                        </p>

                        {{-- <!-- Rating -->
                        <div class="flex items-center mb-6">
                            <div class="flex mr-2">
                                @php
                                    $rating = $game->rating ?? 5;
                                    $fullStars = floor($rating);
                                    $hasHalf = $rating - $fullStars >= 0.5;
                                @endphp
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                @endfor
                                @if ($hasHalf)
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    @php $fullStars++ @endphp
                                @endif
                                @for ($i = $fullStars; $i < 5; $i++)
                                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-sm font-medium text-gray-500">({{ number_format($rating, 1) }})</span>
                        </div> --}}

                        <!-- Price -->
                        <div class="mb-6">
                            <p class="text-4xl font-bold text-dark-blue">ر.س {{ number_format($game->price, 2) }}</p>
                            @if ($game->original_price > $game->price)
                                <p class="text-sm text-gray-500 line-through">ر.س
                                    {{ number_format($game->original_price, 2) }}</p>
                            @endif
                        </div>

                        <!-- Purchase Options -->
                        <div class="space-y-4">
                            <form action="{{ route('game.AddToCart', $game) }}" method="POST">
                                @csrf
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-gray-700 font-medium">الكمية:</span>
                                    <div class="flex items-center border rounded-lg overflow-hidden">

                                        <input type="number" name="quantity" id="quantity" value="1"
                                            min="1" max="99"
                                            class="w-16 text-center border-none outline-none text-gray-800 bg-white" />
                                    </div>
                                </div>

                                <button type="submit"
                                    class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all duration-300 hover:shadow-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                    </svg>
                                    أضف إلى السلة
                                </button>
                            </form>
                            {{--
                            <a href="{{ route('checkout', $game) }}"
                                class="block bg-blue-500 w-full bg-dark-blue hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all duration-300 hover:shadow-lg text-center flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                اشتري الآن
                            </a> --}}
                        </div>

                        <!-- Game Details -->
                        <div class="mt-8 pt-6 border-t">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">تفاصيل اللعبة</h3>
                            <ul class="space-y-2 text-gray-600">
                                <li class="flex justify-between">
                                    <span class="font-medium">النوع:</span>
                                    <span>أكشن، مغامرات</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="font-medium">المنصة:</span>
                                    <span>{{ ucfirst($game->platform ?? 'غير متوفر') }}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="font-medium">تاريخ الإصدار:</span>
                                    <span>{{ date('d M Y', strtotime($game->release_date)) }}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="font-medium">اللغة:</span>
                                    <span>العربية، الإنجليزية</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quantity Control Script -->
    <script>
        function increaseQty() {
            let qty = document.getElementById('quantity');
            if (qty.value < 99) qty.value = parseInt(qty.value) + 1;
        }

        function decreaseQty() {
            let qty = document.getElementById('quantity');
            if (qty.value > 1) qty.value = parseInt(qty.value) - 1;
        }
    </script>
</x-home-layout>
