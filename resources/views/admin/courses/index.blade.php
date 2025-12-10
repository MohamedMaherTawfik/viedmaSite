@php
    $perPage = 3;
    $totalCourses = count($courses);
    $totalPages = ceil($totalCourses / $perPage);
@endphp

<x-layout title="{{ __('main.admin_dashboard') }}">

    {{-- Sidebar --}}
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

           <section class="bg-gray-50 py-12 px-4 sm:px-6 mt-10 lg:px-8" id="courses">
    <div class="max-w-7xl mx-auto">

        <!-- Course Pages -->
        <div id="courses-wrapper">
            @for ($page = 1; $page <= $totalPages; $page++)
                <div class="course-page grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
                    data-page="{{ $page }}" style="{{ $page !== 1 ? 'display:none' : '' }}">
                    @foreach ($courses->forPage($page, $perPage) as $course)
                        <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden flex flex-col transition-all duration-300 ease-in-out hover:shadow-xl hover:-translate-y-1">
                            <div class="h-48 overflow-hidden relative">

                                <img src="{{ $course->cover_photo ? asset('storage/' . $course->cover_photo) : 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/2560px-Placeholder_view_vector.svg.png' }}"
                                    class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">

                                <!-- Start Date -->
                                <div class="absolute bottom-2 left-2 bg-white/80 text-gray-800 text-xs font-medium px-2 py-1 rounded">
                                    {{ $course->start_Date ? date('d M Y', strtotime($course->start_Date)) : '' }}
                                </div>

                                <!-- Level -->
                                <div class="absolute bottom-2 right-2 bg-[#176b98]/90 text-[#FEBE35] text-xs font-semibold px-2 py-1 rounded">
                                    {{ __('main.level_' . strtolower($course->level ?? 'beginner')) }}
                                </div>
                            </div>

                            <div class="p-6 flex-1 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center mb-2">
                                        <span class="inline-block px-3 py-1 text-xs font-semibold text-[#FEBE35] bg-[#176b98] rounded-full">
                                            {{ $course->category->name ?? __('main.general') }}
                                        </span>
                                    </div>

                                    <h3 class="text-xl font-semibold text-gray-900 mb-1">
                                        {{ $course->title }}
                                    </h3>

                                    <p class="text-gray-600 text-sm mb-3">
                                        {{ Str::limit($course->description, 50) }}
                                    </p>

                                    <div class="flex items-center text-sm text-gray-500 mb-2">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v3.586a1 1 0 00.293.707l2 2a1 1 0 001.414-1.414L11 9.586V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $course->duration ?? 0 }} {{ __('main.hours') }}
                                    </div>
                                </div>

                                <div class="mt-auto pt-4 border-t border-gray-100">

                                    <!-- Prices -->
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="text-base font-bold text-[#176b98]">
                                            {{ __('main.teacher_price') }}: {{ $course->price ?? 0 }}
                                        </span>
                                        <span class="text-base font-bold text-[#176b98]">
                                            {{ __('main.admin_price') }}: {{ $course->admin_price ?? 0 }}
                                        </span>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="flex items-center justify-between gap-3">

                                        <!-- Edit Price -->
                                        <button onclick="openModal({{ $course->id }})"
                                            class="flex-1 px-4 py-2 bg-[#176b98D2] text-[#FEBE35] text-sm font-medium rounded-md hover:bg-[#176b98] transition-colors duration-300">
                                            {{ __('main.edit_price') }}
                                        </button>

                                        @if ($course->user_id == auth()->id())
                                            <a href="{{ route('admin.courses.me.show', $course->id) }}"
                                                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                                                {{ __('main.view_course') }}
                                            </a>
                                        @endif

                                        <!-- Delete -->
                                        <form action="{{ route('admin.courses.me.delete', $course->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('main.confirm_delete_course') }}');"
                                            class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 transition-colors duration-300">
                                                {{ __('main.delete') }}
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Edit Price Modal -->
                                    <div id="editPriceModal-{{ $course->id }}"
                                        class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
                                        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">

                                            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                                                {{ __('main.edit_course_price') }}
                                            </h2>

                                            <form action="{{ route('admin.course.edit', $course->id) }}" method="POST">
                                                @csrf

                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                                        {{ __('main.admin_price') }}
                                                    </label>
                                                    <input type="number" step="0.01" name="admin_price"
                                                        value="{{ $course->admin_price }}"
                                                        class="w-full border-gray-300 rounded-md focus:ring-[#176b98] focus:border-[#176b98]">
                                                </div>

                                                <div class="flex justify-end gap-3">
                                                    <button type="button" onclick="closeModal({{ $course->id }})"
                                                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                                                        {{ __('main.cancel') }}
                                                    </button>

                                                    <button type="submit"
                                                        class="px-4 py-2 bg-[#176b98] text-[#FEBE35] rounded-md hover:bg-[#176b98D2] transition">
                                                        {{ __('main.save') }}
                                                    </button>
                                                </div>
                                            </form>

                                            <button onclick="closeModal({{ $course->id }})"
                                                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">✕</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endfor

        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-6 items-center gap-2" id="tabs-wrapper">
            <button id="prev-btn" class="px-3 py-1 bg-gray-200 rounded disabled:opacity-50">
                {{ __('main.prev') }}
            </button>
            <div id="tabs" class="flex gap-2"></div>
            <button id="next-btn" class="px-3 py-1 bg-gray-200 rounded disabled:opacity-50">
                {{ __('main.next') }}
            </button>
        </div>

    </div>
</section>


            <style>
                @keyframes fadeIn {
                    from { opacity: 0; transform: translateY(10px); }
                    to { opacity: 1; transform: translateY(0); }
                }
                .course-page { animation: fadeIn 0.5s ease-in-out; }
                .hover\:shadow-xl:hover { box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04); }
            </style>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const coursePages = document.querySelectorAll('.course-page');
                    const prevBtn = document.getElementById('prev-btn');
                    const nextBtn = document.getElementById('next-btn');
                    const tabsContainer = document.getElementById('tabs');
                    const totalPages = {{ $totalPages }};
                    const maxTabs = 4;
                    let currentPage = 1;

                    function updateCourseView() {
                        coursePages.forEach(page => {
                            page.style.display = parseInt(page.dataset.page) === currentPage ? 'grid' : 'none';
                        });
                    }

                    function renderTabs() {
                        tabsContainer.innerHTML = '';
                        let start = Math.max(1, currentPage - Math.floor(maxTabs/2));
                        let end = start + maxTabs -1;
                        if(end > totalPages){ end = totalPages; start = Math.max(1, end - maxTabs +1); }
                        for(let i=start; i<=end; i++){
                            const btn = document.createElement('button');
                            btn.textContent = i;
                            btn.className = `w-10 h-10 flex items-center justify-center rounded-md text-sm font-semibold transition border border-[#176b98] ${i===currentPage?'bg-[#176b98] text-white':'bg-transparent text-gray-700 hover:bg-[#176b98] hover:text-white'}`;
                            btn.addEventListener('click', ()=>{ currentPage=i; updateView(); });
                            tabsContainer.appendChild(btn);
                        }
                    }

                    function updateView(){
                        updateCourseView();
                        renderTabs();
                        prevBtn.disabled = currentPage === 1;
                        nextBtn.disabled = currentPage === totalPages;
                    }

                    prevBtn.addEventListener('click', ()=>{ if(currentPage>1){ currentPage--; updateView(); } });
                    nextBtn.addEventListener('click', ()=>{ if(currentPage<totalPages){ currentPage++; updateView(); } });

                    updateView();
                });

                function openModal(id){ document.getElementById(`editPriceModal-${id}`).classList.remove('hidden'); }
                function closeModal(id){ document.getElementById(`editPriceModal-${id}`).classList.add('hidden'); }
            </script>

        </main>
    </div>
</x-layout>
