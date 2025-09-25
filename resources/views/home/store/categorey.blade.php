<x-home-layout>

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

    {{-- قسم الكاتيجوري --}}
    <div class="container mx-auto px-4 py-8">
        {{-- عنوان الكاتيجوري --}}
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $categorey->name }}</h1>
            @if ($categorey->description)
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">{{ $categorey->description }}</p>
            @endif
        </div>

        {{-- قائمة الألعاب --}}
        @if ($categorey->games->count() > 0)
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">الألعاب المتاحة</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($categorey->games as $game)
                        <div
                            class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            {{-- صورة اللعبة --}}
                            <div class="h-48 bg-gray-200 overflow-hidden">
                                @if ($game->cover_image)
                                    <img src="{{ asset('storage/' . $game->cover_image) }}" alt="{{ $game->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                        <span class="text-gray-400">لا توجد صورة</span>
                                    </div>
                                @endif
                            </div>

                            {{-- محتوى اللعبة --}}
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2 truncate">
                                    {{ $game->title }}
                                </h3>

                                @if ($game->description)
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                        {{ Str::limit($game->description, 80) }}
                                    </p>
                                @endif
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-blue-600">
                                        @if ($game->price > 0)
                                            ${{ number_format($game->price, 2) }}
                                        @else
                                            <span class="text-green-600">مجاني</span>
                                        @endif
                                    </span>

                                    <a href="{{ route('game.show', $game) }}"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition-colors duration-200">
                                        عرض التفاصيل
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            {{-- حالة عدم وجود ألعاب --}}
            <div class="text-center py-12">
                <div class="bg-white rounded-lg shadow-md p-8 max-w-md mx-auto">
                    <div class="text-6xl mb-4">🎮</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">لا توجد ألعاب في هذا القسم</h3>
                    <p class="text-gray-600 mb-4">لم يتم إضافة أي ألعاب إلى هذه الفئة حتى الآن.</p>
                    <button
                        class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-6 py-2 rounded-lg transition-colors duration-200">
                        تصفح جميع الألعاب
                    </button>
                </div>
            </div>
        @endif
    </div>

</x-home-layout>
