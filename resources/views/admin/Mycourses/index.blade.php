@php
    $perPage = 3;
    $totalCourses = count($courses);
    $totalPages = ceil($totalCourses / $perPage);
@endphp
<x-layout title="{{ __('main.admin_dashboard') }}">

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

            <h3 class="text-left mb-6">
                <a href="{{ route('admin.courses.me.create') }}"
                    class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800 transition flex items-center"
                    style="width:12%">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    {{ __('main.create_course') }}
                </a>
            </h3>

            <section class="bg-gray-50 py-8 px-4 sm:px-6 lg:px-8" id="courses">
                <div class="max-w-7xl mx-auto">

                    <!-- Course Pages -->
                    <div id="courses-wrapper">
                        @for ($page = 1; $page <= $totalPages; $page++)
                            <div class="course-page grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-6"
                                data-page="{{ $page }}" style="{{ $page !== 1 ? 'display:none' : '' }}">

                                @foreach ($courses->forPage($page, $perPage) as $course)
                                    <div
                                        class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden flex flex-col transition-all duration-300 ease-in-out hover:shadow-xl hover:-translate-y-1">
                                        <!-- Course Image -->
                                        <div class="h-44 overflow-hidden relative">
                                            <img src="{{ $course->cover_photo
                                                ? asset('storage/' . $course->cover_photo)
                                                : 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/2560px-Placeholder_view_vector.svg.png' }}"
                                                alt="{{ $course->title }}"
                                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">

                                            <!-- Start Date -->
                                            <div
                                                class="absolute bottom-2 left-2 bg-white/80 backdrop-blur-sm text-gray-800 text-xs font-medium px-2 py-1 rounded shadow-sm">
                                                {{ \Carbon\Carbon::parse($course->start_Date)->format('d M Y') }}
                                            </div>

                                            <!-- Level Badge -->
                                            <div
                                                class="absolute bottom-2 right-2 bg-[#176b98]/90 text-[#FEBE35] text-xs font-semibold px-2 py-1 rounded shadow-sm">
                                                {{ ucfirst($course->level ?? __('main.beginner')) }}
                                            </div>
                                        </div>

                                        <!-- Course Details -->
                                        <div class="p-4 flex flex-col flex-1">
                                            <div>
                                                <div class="flex items-center mb-2">
                                                    <span
                                                        class="inline-block px-2.5 py-1 text-xs font-semibold text-[#FEBE35] bg-[#176b98] rounded-full">
                                                        {{ $course->category->name ?? __('main.general') }}
                                                    </span>
                                                </div>
                                                <h3 class="text-base font-bold text-gray-900 mb-1 line-clamp-1">
                                                    {{ $course->title }}
                                                </h3>
                                                <p class="text-gray-600 text-sm mb-2 line-clamp-2 min-h-[3rem]">
                                                    {{ Str::limit($course->description, 60) }}
                                                </p>
                                                <div class="flex items-center text-xs text-gray-500 mb-2">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v3.586a1 1 0 00.293.707l2 2a1 1 0 001.414-1.414L11 9.586V6z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    {{ $course->duration ?? 0 }} {{ __('main.hours') }}
                                                </div>
                                            </div>

                                            <!-- Prices -->
                                            <div class="mt-3 pt-3 border-t border-gray-100">
                                                <div class="flex justify-between text-center">
                                                    <div class="flex-1 border-r border-gray-100 pr-2">
                                                        <p class="text-xs text-gray-500">{{ __('main.teacher_price') }}
                                                        </p>
                                                        <p class="text-base font-bold text-[#176b98] mt-1">
                                                            {{ $course->price ?? 0 }}
                                                        </p>
                                                    </div>
                                                    <div class="flex-1 pl-2">
                                                        <p class="text-xs text-gray-500">{{ __('main.admin_price') }}
                                                        </p>
                                                        <p class="text-base font-bold text-[#176b98] mt-1">
                                                            {{ $course->admin_price ?? 0 }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Action Buttons -->
                                            <div
                                                class="mt-4 pt-3 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                                <button onclick="openModal({{ $course->id }})"
                                                    class="w-full sm:w-auto px-3 py-1.5 bg-[#176b98] text-[#FEBE35] text-xs font-medium rounded-md hover:bg-[#135a7f] transition">
                                                    {{ __('main.edit_price') }}
                                                </button>

                                                @if (Auth::user()->id == $course->user_id)
                                                    <a href="{{ route('admin.courses.me.show', $course->id) }}"
                                                        class="w-full sm:w-auto px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded-md hover:bg-blue-700 transition text-center">
                                                        {{ __('main.show_course') }}
                                                    </a>
                                                @endif

                                                <form action="{{ route('admin.courses.me.delete', $course->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('{{ __('main.confirm_delete_course') }}');"
                                                    class="w-full sm:w-auto">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="w-full sm:w-auto px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded-md hover:bg-red-700 transition">
                                                        {{ __('main.delete') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Price Edit Modal -->
                                        <div id="editPriceModal-{{ $course->id }}"
                                            class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
                                            <div
                                                class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative mx-4">
                                                <button onclick="closeModal({{ $course->id }})"
                                                    class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</button>

                                                <h2 class="text-lg font-bold text-gray-800 mb-4 text-center">
                                                    {{ __('main.edit_course_price') }}
                                                </h2>

                                                <form action="{{ route('admin.course.edit', $course->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="mb-4">
                                                        <label for="admin_price_{{ $course->id }}"
                                                            class="block text-sm font-medium text-gray-700 mb-1">
                                                            {{ __('main.admin_price') }}
                                                        </label>
                                                        <input type="number" step="0.01" name="admin_price"
                                                            id="admin_price_{{ $course->id }}"
                                                            value="{{ old('admin_price', $course->admin_price) }}"
                                                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-[#176b98] focus:border-transparent">
                                                    </div>
                                                    <div class="flex justify-center space-x-3 pt-2">
                                                        <button type="button"
                                                            onclick="closeModal({{ $course->id }})"
                                                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition font-medium">
                                                            {{ __('main.cancel') }}
                                                        </button>
                                                        <button type="submit"
                                                            class="px-4 py-2 bg-[#176b98] text-[#FEBE35] rounded-md hover:bg-[#135a7f] transition font-medium">
                                                            {{ __('main.save') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endfor
                    </div>

                    <!-- Pagination Controls -->
                    @if ($totalPages > 1)
                        <div class="mt-10 flex justify-center items-center space-x-1.5">
                            <button id="prev-btn"
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition">
                                <span class="hidden sm:inline">{{ __('main.previous') }}</span>
                                <svg class="w-4 h-4 sm:hidden inline" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>

                            <div id="tabs" class="flex space-x-1.5"></div>

                            <button id="next-btn"
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition">
                                <span class="hidden sm:inline">{{ __('main.next') }}</span>
                                <svg class="w-4 h-4 sm:hidden inline" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>
            </section>
        </main>
    </div>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .course-page {
            animation: fadeIn 0.4s ease-out;
        }

        .course-page>div {
            animation: fadeIn 0.3s ease-out;
            animation-fill-mode: both;
        }

        .course-page>div:nth-child(1) {
            animation-delay: 0.05s;
        }

        .course-page>div:nth-child(2) {
            animation-delay: 0.1s;
        }

        .course-page>div:nth-child(3) {
            animation-delay: 0.15s;
        }

        .course-page>div:nth-child(4) {
            animation-delay: 0.2s;
        }
    </style>

    <script>
        // Modal Functions
        function openModal(id) {
            document.getElementById(`editPriceModal-${id}`).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(`editPriceModal-${id}`).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('bg-gray-900') && e.target.classList.contains('bg-opacity-50')) {
                const modals = document.querySelectorAll('[id^="editPriceModal-"]');
                modals.forEach(modal => {
                    if (!modal.classList.contains('hidden')) {
                        const id = modal.id.split('-')[1];
                        closeModal(id);
                    }
                });
            }
        });

        // Pagination Logic
        document.addEventListener("DOMContentLoaded", function() {
            const coursePages = document.querySelectorAll('.course-page');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const totalPages = {{ $totalPages }};
            const maxTabs = 5;
            let currentPage = 1;

            // Initialize tabs
            function renderTabs() {
                const tabsContainer = document.getElementById('tabs');
                tabsContainer.innerHTML = '';

                let startPage = Math.max(1, currentPage - Math.floor(maxTabs / 2));
                let endPage = Math.min(totalPages, startPage + maxTabs - 1);

                if (endPage - startPage + 1 < maxTabs) {
                    startPage = Math.max(1, endPage - maxTabs + 1);
                }

                for (let i = startPage; i <= endPage; i++) {
                    const btn = document.createElement('button');
                    btn.dataset.page = i;
                    btn.textContent = i;
                    btn.className = `w-9 h-9 flex items-center justify-center rounded-md text-sm font-medium transition ${
                        i === currentPage
                            ? 'bg-[#176b98] text-white border border-[#176b98]'
                            : 'bg-white text-gray-700 border border-gray-300 hover:bg-[#176b98] hover:text-white hover:border-[#176b98]'
                    }`;
                    btn.addEventListener('click', () => {
                        currentPage = i;
                        updateView();
                    });
                    tabsContainer.appendChild(btn);
                }
            }

            function updateCourseView() {
                coursePages.forEach(page => {
                    page.style.display = parseInt(page.dataset.page) === currentPage ? 'grid' : 'none';
                });
            }

            function updateView() {
                updateCourseView();
                renderTabs();
                prevBtn.disabled = currentPage === 1;
                nextBtn.disabled = currentPage === totalPages;

                // Scroll to courses section smoothly
                document.getElementById('courses').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }

            prevBtn?.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    updateView();
                }
            });

            nextBtn?.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    updateView();
                }
            });

            // Initialize
            if (totalPages > 0) {
                updateView();
            }
        });
    </script>
</x-layout>
