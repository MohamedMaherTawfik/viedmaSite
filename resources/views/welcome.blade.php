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

    <!-- Hero Section with <img> as Background -->
    <section class="py-20 relative ">
        <!-- الصورة كخلفية باستخدام <img> -->
        <img src="{{ asset('images/game.avif') }}" alt="Game Background"
            class="absolute inset-0 w-full h-full object-cover object-center opacity-100">

        <!-- Overlay أزرق شفاف -->
        <div class="absolute inset-0 bg-dark-blue bg-opacity-60"></div>

        <!-- المحتوى (النص والزر) -->
        <div
            class="container mx-auto px-4 relative z-10 text-center md:text-right flex flex-col items-center justify-center h-full pt-20 pb-20">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 max-w-2xl leading-tight">
                اكتشف مغامرتك القادمة في عالم الألعاب
            </h1>
            <p class="text-lg text-white mb-8 max-w-xl">
                استكشف عالمًا من الألعاب الممتعة والمُعدّة خصيصًا للمعلمين، الآباء، والمدربين.
            </p>
            <button
                class="bg-gold hover:bg-yellow-500 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition-transform duration-300 transform hover:scale-105">
                ابدأ الآن
            </button>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-dark-blue text-center mb-6">عن فيدما</h2>
            <p class="text-lg text-gray-700 text-center max-w-3xl mx-auto mb-10">
                فيدما منصة تهدف إلى دمج التعليم بالترفيه من خلال ألعاب تفاعلية ذكية. مهمتنا هي جعل التعلم ممتعًا وسهلًا
                لكل من المعلمين، الآباء، والمدربين.
            </p>

        </div>
    </section>

    <section class="bg-gray-50 py-12 px-4 sm:px-6 lg:px-8" id="courses">
        <div class="max-w-7xl mx-auto">

            <!-- Header -->
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-dark-blue">الألعاب المرشحة</h2>
                <p class="mt-2 text-lg text-gray-600">الأكثر مبيعًا وتفاعلًا</p>
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
                                        <h3 class="text-xl font-semibold text-gray-900 mb-1">{{ $course->title }}</h3>
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
                                        <div class="flex items-center justify-between text-sm text-gray-700 mb-2">
                                            <div>

                                                <span class="font-bold text-base">المنشئ:</span>
                                                <span class="opacity-60">{{ $course->developer_name }}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <span class="text-gold">★</span>
                                            </div>
                                        </div>
                                        <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                                            <span class="text-lg font-bold text-dark-blue">{{ $course->price ?? 0 }}
                                                SAR</span>
                                            <a href="{{ route('game.show', $course) }}"
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

    <section class="bg-white py-16 text-center" x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)">
        <div class="transition-all duration-700 ease-out transform"
            :class="show ? 'translate-x-0 opacity-100' : '-translate-x-20 opacity-0'">

            <h2 class="text-2xl font-bold text-dark-blue mb-6" :class="show ? 'opacity-100' : 'opacity-0'">
                لماذا تختار فيدما؟
            </h2>

            <p class="max-w-3xl mx-auto text-gray-700 mb-8 transition-all duration-700 delay-300 transform"
                :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                لأننا نقدم أفضل تجربة تعليمية تفاعلية من خلال الألعاب، مع دعم متكامل للمعلمين، الآباء، والمدربين.
            </p>

            <ul class="text-gray-700 text-left max-w-4xl mx-auto space-y-3 mb-10">
                <template
                    x-for="(item, index) in [
                'أكثر من 500,000 طالب وخريج بدأوا رحلتهم معنا.',
                'فريق مكوَّن من أكثر من 100,000 معلم ومدرب محترف.',
                'ألعاب شاملة في الرياضيات، العلوم، اللغات، وتطوير المهارات.',
                'محتوى تفاعلي وسهل مناسب لجميع الأعمار والمستويات.',
                'شهادات إنجاز وفرص لبناء مسيرة تعليمية متميزة.'
            ]"
                    :key="index">
                    <li class="transition-all duration-500 ease-out transform"
                        :style="`transition-delay: ${400 + index * 100}ms`"
                        :class="show ? 'translate-x-0 opacity-100' : '-translate-x-5 opacity-0'">
                        <span class="text-gold font-bold">✔</span>
                        <span x-text="item" class="mr-2"></span>
                    </li>
                </template>
            </ul>

            <!-- إحصائيات -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                <template
                    x-for="(card, idx) in [
                { img: 'https://cdn-icons-png.flaticon.com/128/3449/3449519.png', title: '300,000+ طالب' },
                { img: 'https://cdn-icons-png.flaticon.com/128/3048/3048702.png', title: '200,000+ معلم' },
                { img: 'https://cdn-icons-png.flaticon.com/128/4211/4211708.png', title: '100,000+ خريج' }
            ]"
                    :key="idx">
                    <div class="text-center transition-all duration-700 ease-out transform"
                        :style="`transition-delay: ${1000 + idx * 200}ms`"
                        :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
                        <img :src="card.img" class="mx-auto h-20" alt="">
                        <p class="text-xl font-bold text-dark-blue mt-2" x-text="card.title"></p>
                    </div>
                </template>
            </div>
        </div>
    </section>

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



</x-home-layout>
