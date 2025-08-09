<x-layout title="لوحة تحكم ولي الأمر">

    <!-- Sidebar -->
    <x-parent-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1" x-data="{ category: '', maxPrice: '' }">
            <x-parent-header />


            <h1 class="text-2xl font-bold mb-6">جميع الألعاب</h1>

            <div class="mb-6 flex flex-col md:flex-row items-center gap-4">
                <!-- Max Price Input -->
                <input type="number" x-model="maxPrice" placeholder="أقصى سعر"
                    class="w-full md:w-1/6 border rounded px-3 py-2" />

                <!-- Cart Icon Button -->
                @if (Auth::user()->cart)
                    <a href="{{ route('parent.cart') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center gap-2">
                        <!-- Cart Icon (Heroicons) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.836L5.81 6.75m0 0l1.395 5.582a2.25 2.25 0 002.184 1.668h7.755a2.25 2.25 0 002.184-1.668l1.208-4.832A1.125 1.125 0 0019.46 6.75H5.81zm0 0H4.312M6 21a.75.75 0 100-1.5.75.75 0 000 1.5zm12 0a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                        </svg>
                        <span>السلة</span>
                    </a>
                @endif
            </div>

            {{-- Success Message --}}
            @if (session('success'))
                <div class="p-4 mb-4 text-green-800 bg-green-200 border border-green-300 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Fail Message
            @if (session('fail'))
                <div class="p-4 mb-4 text-red-800 bg-red-200 border border-red-300 rounded">
                    {{ session('fail') }}
                </div>
            @endif --}}

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="p-4 mb-4 text-red-800 bg-red-100 border border-red-300 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 border border-red-300">
                    {{ session('error') }}
                </div>
            @endif


            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($games as $game)
                    <div x-show="(category === '' || category == '{{ $game->games_categorey_id }}') &&
                 (maxPrice === '' || {{ $game->price }} <= parseFloat(maxPrice))
"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-shadow duration-300">

                        <!-- Game Cover with Badges -->
                        <div class="relative">
                            <img src="{{ asset($game->cover_image ? 'storage/' . $game->cover_image : $game->cover_image) }}"
                                alt="{{ $game->title }}"
                                class="w-full h-56 object-cover hover:opacity-90 transition-opacity duration-200">

                            <!-- Discount Badge -->
                            @if ($game->discount > 0)
                                <div
                                    class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    -{{ $game->discount }}%
                                </div>
                            @endif

                            <!-- Status Badge -->
                            <div
                                class="absolute top-4 left-4 bg-{{ $game->is_active ? 'green' : 'red' }}-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                {{ $game->is_active ? 'متاح' : 'غير متاح' }}
                            </div>
                        </div>

                        <!-- Game Basic Info -->
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-2">
                                <h2 class="text-xl font-bold text-gray-800">{{ $game->title }}</h2>
                                <span class="text-lg font-semibold text-gray-900">
                                    @if ($game->discount > 0)
                                        <span class="text-gray-500 line-through text-sm mr-1">{{ $game->price }}
                                            ج.م</span>
                                        {{ $game->price - ($game->price * $game->discount) / 100 }} ج.م
                                    @else
                                        {{ $game->price }} ج.م
                                    @endif
                                </span>
                            </div>

                            <div class="flex items-center text-sm text-gray-600 mb-3">
                                <span class="mr-2">{{ $game->developer_name }}</span>
                                <span class="w-1 h-1 bg-gray-400 rounded-full"></span>
                                <span class="mx-2">{{ $game->platform }}</span>
                            </div>

                            <!-- Collapsible Content -->
                            <div x-data="{ expanded: false }">
                                <!-- Expand/Collapse Button -->
                                <button @click="expanded = !expanded"
                                    class="w-full py-2 text-sm font-medium text-blue-600 hover:text-blue-800 focus:outline-none flex items-center justify-between">
                                    <span>تفاصيل أكثر</span>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 transition-transform duration-200"
                                        :class="{ 'transform rotate-180': expanded }" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Collapsible Content -->
                                <div x-show="expanded" x-collapse class="pt-2 border-t border-gray-100">
                                    <p class="text-sm text-gray-600 mb-3">{{ $game->description }}</p>

                                    <div class="grid grid-cols-2 gap-2 text-sm">
                                        <div class="text-gray-700">
                                            <span class="font-medium">تاريخ الإصدار:</span>
                                            <span>{{ $game->release_date }}</span>
                                        </div>
                                        <div class="text-gray-700">
                                            <span class="font-medium">المخزون:</span>
                                            <span>{{ $game->stock }}</span>
                                        </div>
                                    </div>

                                    @if ($game->trailer_url)
                                        <a href="{{ $game->trailer_url }}" target="_blank"
                                            class="mt-3 inline-flex items-center text-blue-600 hover:text-blue-800 text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            مشاهدة العرض
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-4 flex flex-col sm:flex-row gap-3 sm:items-end">
                                <form action="{{ route('parent.game.AddToCart', $game) }}" method="POST"
                                    class="flex-1 space-y-2">
                                    @csrf
                                    <input type="hidden" name="game_id" value="{{ $game->id }}">

                                    <div>
                                        <label for="quantity"
                                            class="block text-sm font-medium text-gray-700 mb-1">الكمية</label>
                                        <input type="number" id="quantity" name="quantity" min="1"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    </div>

                                    <button type="submit"
                                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg text-sm font-medium transition-colors duration-200">
                                        إضافة إلى السلة
                                    </button>
                                </form>

                                <button
                                    class="h-11 sm:h-auto px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:text-blue-600 hover:border-blue-400 transition-colors duration-200 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </div>


                        </div>
                    </div>
                @endforeach
            </div>
        </main>

    </div>

</x-layout>
