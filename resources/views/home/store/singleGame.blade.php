<x-home-layout>
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Breadcrumbs -->
            <nav class="mb-6">
                <ol class="flex items-center space-x-2 rtl:space-x-reverse text-sm text-gray-600">
                    <li><a href="/" class="hover:text-blue-600 transition">الرئيسية</a></li>
                    <li class="text-gray-400">/</li>
                    <li><a href="{{ route('games.all') }}" class="hover:text-blue-600 transition">الألعاب</a></li>
                    <li class="text-gray-400">/</li>
                    <li class="text-blue-700 font-semibold">{{ $game->title }}</li>
                </ol>
            </nav>

            {{-- رسائل --}}
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
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex flex-col lg:flex-row gap-10">
                <!-- Left Column -->
                <div class="lg:w-2/3">
                    <!-- Main Cover -->
                    <div class="relative rounded-2xl overflow-hidden shadow-lg mb-8 group">
                        <img src="{{ $game->cover_image ? asset('storage/' . $game->cover_image) : 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=' }}"
                            alt="{{ $game->title }}"
                            class="w-full h-96 object-cover transition-transform duration-500 group-hover:scale-105">

                        <!-- Badges -->
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span
                                class="bg-gradient-to-r from-blue-600 to-blue-400 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                                {{ ucfirst($game->platform ?? 'غير متوفر') }}
                            </span>
                            @if ($game->is_new)
                                <span class="bg-red-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                                    جديد
                                </span>
                            @endif
                        </div>

                        <!-- Release Date -->
                        <div class="absolute bottom-4 right-4 bg-black/70 text-white text-sm px-3 py-1 rounded-md">
                            {{ date('d M Y', strtotime($game->release_date)) }}
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-white rounded-2xl shadow p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2"> وصف اللعبة</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $game->description ?? 'لا يوجد وصف متاح حالياً' }}
                        </p>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-2xl shadow-lg sticky top-6 p-6 space-y-6">
                        <!-- Title -->
                        <h1 class="text-3xl font-bold text-gray-900">{{ $game->title }}</h1>

                        <!-- Price -->
                        <div>
                            <p class="text-4xl font-bold text-blue-600">ر.س {{ number_format($game->price, 2) }}</p>
                            @if ($game->original_price > $game->price)
                                <p class="text-sm text-gray-500 line-through">ر.س
                                    {{ number_format($game->original_price, 2) }}</p>
                            @endif
                        </div>

                        <!-- Purchase Form -->
                        <form action="{{ route('game.AddToCart', $game) }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="flex items-center justify-between">
                                <span class="text-gray-700 font-medium">الكمية:</span>
                                <input type="number" name="quantity" id="quantity" value="1" min="1"
                                    max="99" class="w-20 text-center border rounded-lg py-2">
                            </div>
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all duration-300">
                                أضف إلى السلة
                            </button>
                        </form>

                        <!-- Details -->
                        <div class="pt-6 border-t">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">📌 تفاصيل اللعبة</h3>
                            <ul class="space-y-2 text-gray-600">
                                <li class="flex justify-between"><span class="font-medium">النوع:</span><span>أكشن،
                                        مغامرات</span></li>
                                <li class="flex justify-between"><span
                                        class="font-medium">الفئه:</span><span>{{ ucfirst($game->categorey->name ?? 'غير متوفر') }}</span>
                                </li>
                                <li class="flex justify-between"><span class="font-medium">تاريخ
                                        الإصدار:</span><span>{{ date('d M Y', strtotime($game->release_date)) }}</span>
                                </li>
                                <li class="flex justify-between"><span class="font-medium">اللغة:</span><span>العربية،
                                        الإنجليزية</span></li>
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
