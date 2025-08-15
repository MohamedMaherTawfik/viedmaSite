<x-layout title="لوحة تحكم الادمن">

    {{-- sidebar --}}
    <x-admin-sidebar />

    <div class="flex flex-col flex-1">
        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Message --}}
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-admin-header />

            <section class="bg-gray-50 py-12 px-4 sm:px-6 lg:px-8" id="courses">
                <div class="max-w-7xl mx-auto">

                    <div class="mt-4 mb-6">
                        <a href="{{ route('admin.games.create') }}"
                            class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-md shadow">
                            إنشاء لعبة
                        </a>
                    </div>

                    <!-- Course Pages -->
                    <div id="courses-wrapper">
                        @php
                            $perPage = 3;
                            $totalGames = count($games);
                            $totalPages = ceil($totalGames / $perPage);
                        @endphp

                        @for ($page = 1; $page <= $totalPages; $page++)
                            <div class="course-page grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
                                data-page="{{ $page }}" style="{{ $page !== 1 ? 'display:none' : '' }}">
                                @foreach ($games->forPage($page, $perPage) as $course)
                                    <div
                                        class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden flex flex-col transition-all duration-300 ease-in-out hover:shadow-xl hover:-translate-y-1">
                                        <div class="h-48 overflow-hidden relative">
                                            <img src="{{ asset('storage/' . $course->cover_image) }}"
                                                alt="{{ $course->cover_image }}"
                                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">

                                            <!-- تاريخ الإصدار -->
                                            <div
                                                class="absolute bottom-2 left-2 bg-white/90 text-gray-800 text-xs font-medium px-2 py-1 rounded">
                                                {{ date('d M Y', strtotime($course->release_date)) }}
                                            </div>

                                            <div
                                                class="absolute bottom-2 right-2 bg-gold text-white text-xs font-semibold px-2 py-1 rounded">
                                                {{ ucfirst($course->platform ?? 'NONE') }}
                                            </div>
                                        </div>
                                        <div class="p-6 flex-1 flex flex-col justify-between">
                                            <div>
                                                <!-- الفئة -->
                                                <div class="flex items-center mb-2">
                                                    <span
                                                        class="inline-block px-3 py-1 text-xs font-semibold text-white bg-gold rounded-full">
                                                        {{ $course->category->name ?? 'عام' }}
                                                    </span>
                                                </div>
                                                <h3 class="text-xl font-semibold text-gray-900 mb-1">
                                                    {{ $course->title }}</h3>
                                                <p class="text-gray-600 text-sm mb-3">
                                                    {{ Str::limit($course->description, 50) }}
                                                </p>
                                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                                    <a href="{{ $course->trailer_url ?? '#' }}"
                                                        class="text-dark-blue hover:underline">
                                                        مشاهدة الترويجي
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="mt-auto">
                                                <div
                                                    class="flex items-center justify-between text-sm text-gray-700 mb-2">
                                                    <div>

                                                        <span class="font-bold text-base"> المنشئ : </span>
                                                        <span class="opacity-60">{{ $course->developer_name }}</span>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <span class="text-gold">★</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="pt-4 border-t border-gray-100 flex items-center justify-between">
                                                    <span
                                                        class="text-lg font-bold text-dark-blue">{{ $course->price ?? 0 }}
                                                        SAR</span>
                                                    <a href="{{ route('admin.games.show', $course) }}"
                                                        class="bg-[#3b82f6] hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition duration-300">
                                                        عرض المزيد
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endfor
                    </div>

                    <!-- Pagination Controls -->
                    <div class="mt-12 flex justify-center items-center space-x-2">
                        <button id="prev-btn"
                            class="px-4 py-2 border border-dark-blue rounded-md text-sm font-medium text-gray-700 hover:bg-dark-blue hover:text-white transition">
                            السابق
                        </button>

                        <div id="tabs" class="flex space-x-1">
                            @for ($i = 1; $i <= $totalPages; $i++)
                                <button data-page="{{ $i }}"
                                    class="w-10 h-10 flex items-center justify-center rounded-md text-sm font-semibold transition
                            {{ $i === 1 ? 'bg-dark-blue text-white' : 'bg-white text-dark-blue hover:bg-dark-blue hover:text-white' }}
                            border border-dark-blue">
                                    {{ $i }}
                                </button>
                            @endfor
                        </div>

                        <button id="next-btn"
                            class="px-4 py-2 border border-dark-blue rounded-md text-sm font-medium text-gray-700 hover:bg-dark-blue hover:text-white transition">
                            التالي
                        </button>
                    </div>
                </div>
            </section>

        </main>


    </div>

</x-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const coursePages = document.querySelectorAll('.course-page');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const totalPages = {{ $totalPages }};
        const maxTabs = 4;

        let currentPage = 1;

        function updateCourseView() {
            coursePages.forEach(page => {
                page.style.display = parseInt(page.dataset.page) === currentPage ? 'grid' : 'none';
            });
        }

        function renderTabs() {
            const tabsContainer = document.getElementById('tabs');
            tabsContainer.innerHTML = '';

            let start = Math.max(1, currentPage - Math.floor(maxTabs / 2));
            let end = start + maxTabs - 1;

            if (end > totalPages) {
                end = totalPages;
                start = Math.max(1, end - maxTabs + 1);
            }
            for (let i = start; i <= end; i++) {
                const btn = document.createElement('button');
                btn.dataset.page = i;
                btn.textContent = i;
                btn.className = `w-10 h-10 flex items-center justify-center rounded-md text-sm font-semibold transition border border-dark-blue ${
                        i === currentPage
                            ? 'bg-dark-blue text-white'
                            : 'bg-white text-dark-blue hover:bg-dark-blue hover:text-white'
                    }`;
                btn.addEventListener('click', () => {
                    currentPage = i;
                    updateView();
                });
                tabsContainer.appendChild(btn);
            }
        }

        function updateView() {
            updateCourseView();
            renderTabs();
            prevBtn.disabled = currentPage === 1;
            nextBtn.disabled = currentPage === totalPages;
        }

        prevBtn.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                updateView();
            }
        });

        nextBtn.addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                updateView();
            }
        });

        updateView();
    });
</script>
