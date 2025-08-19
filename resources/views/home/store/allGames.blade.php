<x-home-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" dir="rtl">
        <!-- Page Header and Search Filter -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">ألعاب تعليمية</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-8">
                اكتشف مجموعة متنوعة من الألعاب التعليمية الممتعة والمفيدة
            </p>

            <!-- Search and Filter -->
            <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input id="searchInput" type="text" placeholder="ابحث عن لعبة..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="w-full md:w-48">
                        <select id="platformSelect"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">كل المنصات</option>
                            @foreach ($games->pluck('platform')->unique() as $platform)
                                <option value="{{ $platform }}">{{ $platform }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Games Listing -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">
                    <span id="gamesCount">0</span> لعبة متاحة
                </h2>
                <div class="flex items-center">
                    <span class="mr-2 text-gray-600">ترتيب حسب:</span>
                    <select id="sortSelect"
                        class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="newest">الأحدث</option>
                        <option value="oldest">الأقدم</option>
                        <option value="price_high">الأعلى سعراً</option>
                        <option value="price_low">الأقل سعراً</option>
                    </select>
                </div>
            </div>

            <!-- Games Grid -->
            <div id="gamesGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($games as $game)
                    <div class="game-card bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300"
                        data-id="{{ $game->id }}" data-title="{{ $game->title }}"
                        data-description="{{ $game->description }}" data-price="{{ $game->price }}"
                        data-discount="{{ $game->discount }}" data-release_date="{{ $game->release_date }}"
                        data-developer_name="{{ $game->developer_name }}" data-platform="{{ $game->platform }}"
                        data-cover_image="{{ $game->cover_image }}" data-trailer_url="{{ $game->trailer_url }}">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $game->cover_image) }}" alt="{{ $game->title }}"
                                class="w-full h-48 object-cover">
                            <div class="absolute top-2 left-2 bg-blue-600 text-white text-xs px-2 py-1 rounded">
                                {{ $game->platform }}
                            </div>
                            @if ($game->discount > 0)
                                <div class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">
                                    خصم {{ $game->discount }}%
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $game->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $game->description }}</p>

                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    @if ($game->discount > 0)
                                        <span class="text-lg font-bold text-blue-600">
                                            {{ number_format($game->price * (1 - $game->discount / 100), 2) }} ر.س
                                        </span>
                                        <span class="text-sm text-gray-500 line-through mr-2">
                                            {{ number_format($game->price, 2) }} ر.س
                                        </span>
                                    @else
                                        <span
                                            class="text-lg font-bold text-blue-600">{{ number_format($game->price, 2) }}
                                            ر.س</span>
                                    @endif
                                </div>
                                <div class="text-sm text-gray-500">{{ date('Y', strtotime($game->release_date)) }}
                                </div>
                            </div>

                            <div class="flex justify-between items-center mb-4">
                                <span class="text-sm text-gray-600">{{ $game->developer_name }}</span>
                                @if ($game->trailer_url)
                                    <a href="{{ $game->trailer_url }}" target="_blank"
                                        class="text-blue-500 hover:text-blue-700 text-sm">مشاهدة العرض</a>
                                @endif
                            </div>

                            <a href="{{ route('game.show', $game) }}"
                                class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-medium py-2 px-4 rounded-lg transition duration-300">
                                عرض المزيد
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- No Results -->
            <div id="noResults" class="hidden text-center py-12 bg-white rounded-xl shadow">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">لا توجد ألعاب متطابقة</h3>
                <p class="mt-1 text-gray-500">حاول تغيير معايير البحث الخاصة بك</p>
                <div class="mt-6">
                    <button id="resetFiltersBtn"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                        إعادة تعيين الفلتر
                    </button>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const searchInput = document.getElementById('searchInput');
                const platformSelect = document.getElementById('platformSelect');
                const sortSelect = document.getElementById('sortSelect');
                const gamesGrid = document.getElementById('gamesGrid');
                const gamesCount = document.getElementById('gamesCount');
                const noResults = document.getElementById('noResults');
                const resetFiltersBtn = document.getElementById('resetFiltersBtn');

                // نخزن البيانات أول ما الصفحة تفتح
                const allGames = Array.from(document.querySelectorAll('.game-card')).map(card => ({
                    id: card.dataset.id,
                    title: card.dataset.title,
                    description: card.dataset.description,
                    price: parseFloat(card.dataset.price),
                    discount: parseFloat(card.dataset.discount),
                    release_date: card.dataset.release_date,
                    developer_name: card.dataset.developer_name,
                    platform: card.dataset.platform,
                    cover_image: card.querySelector('img').src, // 🔹 المسار الحقيقي للصورة
                    trailer_url: card.dataset.trailer_url
                }));


                function renderGames(list) {
                    gamesGrid.innerHTML = '';
                    if (list.length === 0) {
                        noResults.classList.remove('hidden');
                        gamesCount.textContent = 0;
                        return;
                    }
                    noResults.classList.add('hidden');
                    gamesCount.textContent = list.length;

                    list.forEach(game => {
                        let discountedPrice = game.discount > 0 ? (game.price * (1 - game.discount / 100))
                            .toFixed(2) : null;
                        let html = `
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="relative">
                        <img src="${game.cover_image}" alt="${game.title}" class="w-full h-48 object-cover">
                        <div class="absolute top-2 left-2 bg-blue-600 text-white text-xs px-2 py-1 rounded">${game.platform}</div>
                        ${game.discount > 0 ? `<div class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">خصم ${game.discount}%</div>` : ''}
                    </div>
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">${game.title}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">${game.description}</p>

                        <div class="flex justify-between items-center mb-4">
                            <div>
                                ${discountedPrice ? `
                                                                                                                                                                            <span class="text-lg font-bold text-blue-600">${discountedPrice} ر.س</span>
                                                                                                                                                                            <span class="text-sm text-gray-500 line-through mr-2">${game.price.toFixed(2)} ر.س</span>
                                                                                                                                                                        ` : `
                                                                                                                                                                            <span class="text-lg font-bold text-blue-600">${game.price.toFixed(2)} ر.س</span>
                                                                                                                                                                        `}
                            </div>
                            <div class="text-sm text-gray-500">${new Date(game.release_date).getFullYear()}</div>
                        </div>

                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-gray-600">${game.developer_name}</span>
                            ${game.trailer_url ? `<a href="${game.trailer_url}" target="_blank" class="text-blue-500 hover:text-blue-700 text-sm">مشاهدة العرض</a>` : ''}
                        </div>

                        <a href="/game/show/${game.id}/details" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-medium py-2 px-4 rounded-lg transition duration-300">عرض المزيد</a>
                    </div>
                </div>
            `;
                        gamesGrid.insertAdjacentHTML('beforeend', html);
                    });
                }

                function filterGames() {
                    let games = [...allGames];
                    let q = searchInput.value.toLowerCase();
                    let platform = platformSelect.value;
                    let sortBy = sortSelect.value;

                    if (q) {
                        games = games.filter(g =>
                            g.title.toLowerCase().includes(q) ||
                            g.description.toLowerCase().includes(q) ||
                            g.platform.toLowerCase().includes(q)
                        );
                    }

                    if (platform) {
                        games = games.filter(g => g.platform === platform);
                    }

                    switch (sortBy) {
                        case 'newest':
                            games.sort((a, b) => new Date(b.release_date) - new Date(a.release_date));
                            break;
                        case 'oldest':
                            games.sort((a, b) => new Date(a.release_date) - new Date(b.release_date));
                            break;
                        case 'price_high':
                            games.sort((a, b) => b.price - a.price);
                            break;
                        case 'price_low':
                            games.sort((a, b) => a.price - b.price);
                            break;
                    }

                    renderGames(games);
                }

                searchInput.addEventListener('input', filterGames);
                platformSelect.addEventListener('change', filterGames);
                sortSelect.addEventListener('change', filterGames);

                resetFiltersBtn.addEventListener('click', () => {
                    searchInput.value = '';
                    platformSelect.value = '';
                    sortSelect.value = 'newest';
                    filterGames();
                });

                // أول تحميل
                filterGames();
            });
        </script>

    </div>
</x-home-layout>
