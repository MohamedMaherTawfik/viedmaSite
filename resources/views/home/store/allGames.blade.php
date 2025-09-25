<x-home-layout>
    <div class="w-full px-6 lg:px-12 py-10">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">🎮 الألعاب التعليمية</h1>
            <p class="text-lg text-gray-600">ابحث عن لعبتك المفضلة حسب الاسم، السعر أو الفئة</p>
        </div>

        <div class="flex flex-col md:flex-row gap-10">
            <!-- Filters Sidebar -->
            <div class="order-2 md:order-1 md:w-72 lg:w-80 h-fit md:sticky md:top-6 bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-6">فلترة النتائج</h3>

                <!-- Search Box -->
                <div class="mb-6">
                    <label for="searchInput" class="block text-sm font-medium text-gray-700 mb-2">ابحث بالاسم</label>
                    <input id="searchInput" type="text" placeholder="اسم اللعبة..."
                        class="filter-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Category Filter -->
                <div class="mb-6">
                    <label for="categorySelect" class="block text-sm font-medium text-gray-700 mb-2">التصنيف</label>
                    <select id="categorySelect"
                        class="filter-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">كل التصنيفات</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Price Range Filter -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">نطاق السعر</label>
                    <div class="flex items-center gap-2">
                        <input type="number" id="minPrice" placeholder="الحد الأدنى"
                            class="filter-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <span class="text-gray-500">-</span>
                        <input type="number" id="maxPrice" placeholder="الحد الأقصى"
                            class="filter-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Reset Button -->
                <button id="resetFiltersBtn"
                    class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg transition duration-200">
                    إعادة تعيين
                </button>
            </div>

            <!-- Games Grid -->
            <div class="order-1 md:order-2 flex-1">
                <div id="gamesGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
                    <!-- الألعاب هتتزرع بالـ JS -->
                </div>

                <!-- لا توجد نتائج -->
                <div id="noResults" class="hidden col-span-full text-center py-16 bg-white rounded-xl shadow">
                    <h3 class="text-xl font-medium text-gray-800">لا توجد ألعاب</h3>
                    <p class="text-gray-500">حاول تعديل الفلاتر</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // 🟦 البيانات من الباكند كـ JSON
        const games = @json($games);
        const categories = @json($categories);

        const grid = document.getElementById('gamesGrid');
        const noResults = document.getElementById('noResults');

        const searchInput = document.getElementById('searchInput');
        const categorySelect = document.getElementById('categorySelect');
        const minPrice = document.getElementById('minPrice');
        const maxPrice = document.getElementById('maxPrice');
        const resetBtn = document.getElementById('resetFiltersBtn');

        // 🟩 دالة رسم الكارت
        function renderCard(game) {
            let categoryName = game.category?.name ?? 'بدون تصنيف';
            let img = game.cover_image ??
                'https://t4.ftcdn.net/jpg/06/71/92/37/360_F_671923740_x0zOL3OIuUAnSF6sr7PuznCI5bQFKhI0.jpg';
            let url = `/home/game/show/${game.id}/details`;

            return `
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden flex flex-col">
                    <img src="${img}" alt="${game.title}" class="w-full h-56 object-cover">
                    <div class="p-6 text-center flex-1 flex flex-col">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">${game.title}</h3>
                        <p class="text-2xl font-bold text-blue-600 mb-3">${parseFloat(game.price).toFixed(2)} ر.س</p>
                        <span class="text-sm text-gray-500 mb-4 block">${categoryName}</span>
                        <a href="${url}" class="mt-auto inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-3 px-6 rounded-lg transition duration-300">
                            عرض
                        </a>
                    </div>
                </div>
            `;
        }

        // 🟦 دالة الفلترة
        function filterGames() {
            let search = searchInput.value.toLowerCase();
            let category = categorySelect.value;
            let min = parseFloat(minPrice.value) || 0;
            let max = parseFloat(maxPrice.value) || Infinity;

            let filtered = games.filter(g => {
                let matchesSearch = g.title.toLowerCase().includes(search);
                let matchesCategory = !category || g.games_categorey_id == category;
                let matchesPrice = g.price >= min && g.price <= max;
                return matchesSearch && matchesCategory && matchesPrice;
            });

            grid.innerHTML = filtered.map(renderCard).join('');
            noResults.classList.toggle('hidden', filtered.length > 0);
        }

        // 🟧 Events
        [searchInput, categorySelect, minPrice, maxPrice].forEach(input => {
            input.addEventListener('input', filterGames);
        });

        resetBtn.addEventListener('click', () => {
            searchInput.value = '';
            categorySelect.value = '';
            minPrice.value = '';
            maxPrice.value = '';
            filterGames();
        });

        // 🟩 أول تحميل
        filterGames();
    </script>
</x-home-layout>
