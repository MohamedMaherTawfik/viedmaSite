<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $course->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://source.zoom.us/3.11.5/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/3.11.5/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/3.11.5/zoom-meeting-embedded.min.js"></script>
    <style>
        #meetingSDKElement {
            width: 100%;
            height: 100vh;
        }
    </style>
    <!-- Add Alpine.js if not already included -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-gray-50 text-gray-800">

    {{-- navbar --}}
    <x-navbar />

    <!-- Course Header -->

    <div class="max-w-5xl mx-auto py-6 px-4" x-data="{ activeTab: 'overview' }">

        <!-- Navigator Tabs -->
        <div class="flex border-b border-gray-200 pb-4 mb-6">
            <a href="#" @click.prevent="activeTab = 'overview'" class="mr-6 font-medium transition-colors"
                :class="activeTab === 'overview' ? 'text-[#176b98] border-b-2 border-[#176b98]' :
                    'text-gray-600 hover:text-[#176b98]'"
                id="overview-tab">
                Overview
            </a>

            <a href="#" @click.prevent="activeTab = 'notes'" class="mr-6 font-medium transition-colors"
                :class="activeTab === 'notes' ? 'text-[#176b98] border-b-2 border-[#176b98]' :
                    'text-gray-600 hover:text-[#176b98]'"
                id="notes-tab">
                Notes
            </a>

            <a href="#" @click.prevent="activeTab = 'graduation'" class="mr-6 font-medium transition-colors"
                :class="activeTab === 'graduation' ? 'text-[#176b98] border-b-2 border-[#176b98]' :
                    'text-gray-600 hover:text-[#176b98]'"
                id="graduation-tab">
                Graduation Project
            </a>
            {{--
             <a href="#" @click.prevent="activeTab = 'quizzes'" class="mr-6 font-medium transition-colors"
                 :class="activeTab === 'quizzes' ? 'text-[#176b98] border-b-2 border-[#176b98]' :
                     'text-gray-600 hover:text-[#176b98]'">
                 Quizzes
             </a>

             <a href="#" @click.prevent="activeTab = 'Join Meeting'" class="mr-6 font-medium transition-colors"
                 :class="activeTab === 'Join Meeting' ? 'text-[#176b98] border-b-2 border-[#176b98]' :
                     'text-gray-600 hover:text-[#176b98]'">
                 Join Meeting
             </a> --}}

        </div>

        <!-- Overview Section -->
        <div x-show="activeTab === 'overview'" id="overview-section" x-transition>
            <h1 class="text-3xl font-bold mb-3">{{ $course->title }}</h1>

            <div class="mb-4 flex justify-center">
                <img src="{{ asset('storage/' . $course->cover_photo) }}" alt="{{ $course->name }}"
                    class="w-1/2 h-auto object-cover rounded-lg transition-transform duration-300 hover:scale-105">
            </div>


            <!-- Rating and Metadata -->
            <div class="flex items-center mb-4">
                <div class="flex items-center mr-4">
                    <span class="text-amber-400 font-bold mr-1">5</span>
                    <div class="flex">
                        <svg class="w-5 h-5 text-amber-400 fill-current" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.286 3.966c.3.921-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.784.57-1.838-.197-1.539-1.118l1.285-3.966a1 1 0 00-.364-1.118L2.095 9.394c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.951-.69l1.285-3.967z" />
                        </svg>
                    </div>
                    <span class="text-gray-600 ml-1">{{ count($course->enrollments) }} student</span>
                </div>
                <span class="text-gray-600 mr-4">{{ $course->duration }} hours</span>
                <span class="text-gray-600">{{ count($course->review) }}</span>
            </div>

            <!-- Additional Info -->
            <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-6">
                <div>Students</div>
                <div>Total</div>
                <div>
                    {{ $course->updated_at ? $course->updated_at->format('Y-m-d') : '-' }}
                </div>

            </div>

            <!-- Learning Scheduler Section -->
            <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 mb-6">
                <h3 class="font-bold text-lg mb-2">Schedule learning time</h3>
                <p class="text-gray-700 mb-3">{{ $course->description }}</p>
            </div>

            <!-- Star Rating -->
            @php
                use App\Models\Reviews;
                $rating = Reviews::where('user_id', Auth::user()->id)
                    ->where('courses_id', $course->id)
                    ->get();
            @endphp

            {{-- @if (count($rating) >= 1)
             @else
                 <form action="{{ route('course.review', $course->slug) }}" method="POST" class="star-rating">
                     @csrf
                     @for ($i = 5; $i >= 1; $i--)
                         <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}"
                             onchange="this.form.submit()">
                         <label for="star{{ $i }}"
                             title="{{ $i }} star{{ $i > 1 ? 's' : '' }}">★</label>
                     @endfor
                 </form>

             @endif --}}



        </div>

        <!-- Notes Section -->
        <div x-show="activeTab === 'notes'" id="notes-section" x-transition>
            <h3 class="text-xl font-semibold mb-4">Notes</h3>
            <p class="text-gray-700 mb-4">Here you can display user notes, lesson summaries, or add custom fields.</p>

            <!-- Example Note Entry -->
            <div class="bg-white p-4 rounded border border-gray-200 shadow-sm">
                <h4 class="font-bold mb-2">Note Title</h4>
                <p class="text-sm text-gray-600">This is an example note related to the course or a specific lesson.
                </p>
            </div>

            <!-- Add your notes input field or loop here -->
        </div>

        <!-- Graduation Project Section -->
        <div x-show="activeTab === 'graduation'" id="graduation-section" x-transition>
            <h3 class="text-2xl font-bold text-[#79131d] mb-4">{{ __('messages.graduation_project') }}</h3>

            @if ($projects->isEmpty())
                <div class="text-center py-10 text-gray-600 bg-white rounded-lg shadow border">
                    {{ __('messages.no_project') }}
                </div>
            @else
                @foreach ($projects as $item)
                    @foreach ($assignemtns as $assign)
                        @if ($assign->graduation_project_id == $item->id)
                            <p class="font-bold text-dark text-3xl">{{ __('messages.project_uploaded') }}</p>
                            <hr>
                        @else
                            <div class="bg-blue-50 border border-blue-100 p-6 rounded-lg mb-6">
                                <h4 class="text-xl font-semibold mb-2">
                                    {{ $item->title ?? __('messages.project_title') }}</h4>
                                <p class="text-gray-700 mb-3">
                                    {{ $item->description ?? __('messages.project_description') }}</p>

                                @if (!empty($item->file) && Storage::disk('public')->exists($item->file))
                                    <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                        class="flex items-center space-x-2 text-[#79131d] hover:text-[#5a0e16] transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path d="M4 2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V8l-6-6H4z" />
                                            <path d="M14 2v6h6" />
                                        </svg>
                                        <button type="button"
                                            class="inline-flex items-center px-4 py-2 bg-[#79131d] text-[#e4ce96] rounded hover:bg-[#5a0e16] transition text-sm font-medium">
                                            {{ __('messages.show_project') }}
                                        </button>
                                    </a>
                                @else
                                    <p class="text-sm text-red-500">{{ __('messages.no_file') }}</p>
                                @endif
                            </div>

                            <form action="{{ route('messages.project.submit', $item) }}" method="POST"
                                enctype="multipart/form-data"
                                class="bg-white p-6 rounded-lg shadow border border-gray-200 space-y-4">
                                @csrf

                                <div>
                                    <label for="project_file" class="block text-sm font-medium text-gray-700 mb-1">
                                        {{ __('messages.submit_work') }}
                                    </label>
                                    <input type="file" id="project_file" name="project_file" accept=".pdf,.docx,.zip"
                                        required
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#79131d] focus:border-[#79131d]">
                                </div>

                                <button type="submit"
                                    class="bg-[#79131d] text-[#e4ce96] hover:bg-[#5a0e16] px-4 py-2 rounded font-semibold text-sm transition-colors duration-300">
                                    {{ __('messages.submit_project') }}
                                </button>
                            </form>
                        @endif
                    @endforeach
                @endforeach
            @endif
        </div>


    </div>
    <!-- Lessons List -->
    @php
        $lessons = $course->lessons;
        $perPage = 3;
        $totalLessons = count($lessons);
        $totalPages = ceil($totalLessons / $perPage);
    @endphp

    <!-- Custom Loader -->
    <div id="lesson-loader" class="fixed inset-0 bg-white/80 flex items-center justify-center z-50">
        <div class="w-16 h-16 border-[6px] border-[#176b98] border-t-transparent rounded-full animate-spin"></div>
    </div>

    <div class="max-w-5xl mx-auto px-4 mb-16" x-data="{ expandedCard: null }">
        <h2 class="text-2xl font-semibold mb-6">Lessons</h2>

        @if ($lessons->isEmpty())
            <div class="text-center py-10 text-gray-600 bg-white rounded-lg shadow border">
                No lessons available
            </div>
        @else
            <!-- Lessons Tabs -->
            <div id="lessons-wrapper" class="relative">
                @for ($page = 1; $page <= $totalPages; $page++)
                    <div class="lesson-page grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 transition-all duration-300 ease-in-out"
                        data-page="{{ $page }}" style="{{ $page !== 1 ? 'display:none' : '' }}">
                        @foreach ($lessons->forPage($page, $perPage) as $lesson)
                            <!-- الكارد بتاع الدرس هنا -->
                            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden flex flex-col transition-all duration-300 ease-in-out hover:shadow-xl hover:-translate-y-1"
                                x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false"
                                :class="{
                                    'scale-105 z-10': expandedCard === {{ $lesson->id }},
                                    'scale-100': expandedCard !== {{ $lesson->id }}
                                }"
                                @click="expandedCard = expandedCard === {{ $lesson->id }} ? null : {{ $lesson->id }}">
                                <!-- صورة الكارد -->
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $lesson->image) }}" alt="{{ $lesson->title }}"
                                        class="h-40 w-full object-cover transition-all duration-300"
                                        :class="{ 'brightness-75': isHovered }">

                                    <!-- زرار التشغيل -->
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-300"
                                        :class="{ 'opacity-100': isHovered }">
                                        <div class="bg-[#176b98DA] bg-opacity-80 rounded-full p-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- محتوى الكارد -->
                                <div class="p-4 flex-1 flex flex-col justify-between transition-all duration-300"
                                    :class="{
                                        'h-auto': expandedCard === {{ $lesson->id }},
                                        'h-40': expandedCard !== {{ $lesson->id }}
                                    }">
                                    <div>
                                        <h3 class="text-lg font-bold mb-1 text-gray-800">
                                            {{ \Illuminate\Support\Str::limit($lesson->title, 25) }}
                                        </h3>
                                        <p class="text-sm text-gray-600 transition-all duration-300"
                                            :class="{
                                                'line-clamp-3': expandedCard !== {{ $lesson->id }},
                                                'line-clamp-none': expandedCard === {{ $lesson->id }}
                                            }">
                                            {{ $lesson->description }}
                                        </p>
                                    </div>
                                    <div class="mt-4 transition-all duration-300"
                                        :class="{
                                            'opacity-100 translate-y-0': expandedCard === {{ $lesson->id }} ||
                                                isHovered,
                                            'opacity-0 translate-y-2': expandedCard !== {{ $lesson->id }} && !
                                                isHovered
                                        }">
                                        <a href="{{ route('web.courses.enrolled.lesson', $lesson) }}"
                                            class="inline-block bg-[#176b98DA] text-[#e4ce96] px-4 py-2 rounded hover:bg-[#074E74DA] font-medium text-sm transition-colors duration-300 flex items-center">
                                            Go to Lesson
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endfor
            </div>

            <!-- Pagination Controls -->
            <div class="mt-10 flex justify-center items-center space-x-2">
                <button id="lesson-prev-btn"
                    class="px-4 py-2 border rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 transition-colors duration-200"
                    disabled>
                    Previous
                </button>

                <div id="lesson-tabs" class="flex space-x-1">
                    @php
                        $currentPage = 1;
                        $visibleTabs = 4;
                        $start = 1;
                        $end = min($totalPages, $visibleTabs);
                    @endphp

                    @for ($i = $start; $i <= $end; $i++)
                        <button data-page="{{ $i }}"
                            class="w-10 h-10 flex items-center justify-center rounded-md text-sm font-semibold transition-all duration-200 border border-[#176b98]
                        {{ $i === 1 ? 'bg-[#176b98] text-white' : 'bg-transparent text-gray-700 hover:bg-[#176b98] hover:text-white' }}">
                            {{ $i }}
                        </button>
                    @endfor
                </div>

                <button id="lesson-next-btn"
                    class="px-4 py-2 border rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                    Next
                </button>
            </div>
        @endif
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('lesson-loader').style.display = 'none';

            const lessonPages = document.querySelectorAll('.lesson-page');
            const prevBtn = document.getElementById('lesson-prev-btn');
            const nextBtn = document.getElementById('lesson-next-btn');
            const totalPages = {{ $totalPages }};
            const maxTabs = 4;
            let currentPage = 1;

            function updateLessonView() {
                lessonPages.forEach(page => {
                    if (parseInt(page.dataset.page) === currentPage) {
                        page.style.display = 'grid';
                        page.style.animation = 'fadeIn 0.5s ease-in-out';
                    } else {
                        page.style.display = 'none';
                    }
                });
            }

            function renderLessonTabs() {
                const tabsContainer = document.getElementById('lesson-tabs');
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
                    btn.className = `w-10 h-10 flex items-center justify-center rounded-md text-sm font-semibold transition-all duration-200 border border-[#176b98] ${
                    i === currentPage
                        ? 'bg-[#176b98] text-white'
                        : 'bg-transparent text-gray-700 hover:bg-[#176b98] hover:text-white'
                }`;
                    btn.addEventListener('click', () => {
                        currentPage = i;
                        updateLessonView();
                        renderLessonTabs();
                        prevBtn.disabled = currentPage === 1;
                        nextBtn.disabled = currentPage === totalPages;
                    });
                    tabsContainer.appendChild(btn);
                }
            }

            prevBtn.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    updateLessonView();
                    renderLessonTabs();
                    prevBtn.disabled = currentPage === 1;
                    nextBtn.disabled = currentPage === totalPages;
                }
            });

            nextBtn.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    updateLessonView();
                    renderLessonTabs();
                    prevBtn.disabled = currentPage === 1;
                    nextBtn.disabled = currentPage === totalPages;
                }
            });

            updateLessonView();
            renderLessonTabs();
        });
    </script>

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

        .lesson-page {
            animation: fadeIn 0.5s ease-in-out;
        }

        .shadow-lg {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
                0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .hover\:shadow-xl:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        #lesson-loader {
            transition: opacity 0.4s ease;
        }
    </style>

    <!-- Related Courses -->
    <div class="bg-gray-100 py-10 px-4">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-2xl font-semibold mb-6">Related Courses</h2>

            @if ($relatedCourses->isEmpty())
                <div class="text-center py-10 text-gray-600 bg-white rounded-lg shadow border">
                    No related courses for now
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($relatedCourses as $related)
                        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden flex flex-col transition-all duration-300 ease-in-out hover:shadow-xl hover:-translate-y-1 cursor-pointer"
                            x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false"
                            :class="{ 'scale-105 z-10': isHovered, 'scale-100': !isHovered }">

                            <!-- Image with overlay effect -->
                            <div class="relative">
                                <img src="{{ asset('storage/' . $related->cover_photo_url) }}"
                                    alt="{{ $related->title }}"
                                    class="h-40 w-full object-cover transition-all duration-300"
                                    :class="{ 'brightness-75': isHovered }">

                                <!-- Overlay Button -->
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-300"
                                    :class="{ 'opacity-100': isHovered }">
                                    <div class="bg-[#176b98DA] bg-opacity-80 rounded-full p-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-4 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800 mb-1">
                                        {{ \Illuminate\Support\Str::limit($related->title, 40) }}
                                    </h3>
                                    <p class="text-sm text-gray-600 line-clamp-2">
                                        {{ \Illuminate\Support\Str::limit($related->description, 80) }}
                                    </p>
                                </div>
                                <div class="mt-4 transition-all duration-300"
                                    :class="{ 'opacity-100 translate-y-0': isHovered, 'opacity-0 translate-y-2': !isHovered }">
                                    <a href="{{ route('web.courses.show', $related->slug) }}"
                                        class="inline-block bg-[#176b98] p-2 mt-2 text-[#e4ce96] hover:bg-[#5a0e16] text-sm font-medium rounded transition duration-300 flex items-center">
                                        View Course
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    {{-- footer --}}
    <x-footer />


    <style>
        .star-rating {
            direction: rtl;
            /* Makes hover effect work right-to-left */
            display: inline-flex;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: #e2e8f0;
            /* Default gray color (Tailwind's slate-200) */
            cursor: pointer;
            font-size: 2rem;
            padding: 0 2px;
        }

        .star-rating label:hover,
        .star-rating label:hover~label,
        .star-rating input:checked~label {
            color: #fbbf24;
            /* Gold color (Tailwind's amber-400) */
        }
    </style>

    <script>
        // Optional: Log the selected rating to console
        document.querySelectorAll('.star-rating input').forEach(star => {
            star.addEventListener('change', (e) => {
                console.log(`Selected rating: ${e.target.value}`);
            });
        });
    </script>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.effect(() => {
                // نجيب قيمة التاب الحالية من x-data
                const root = document.querySelector('[x-data]');
                if (!root) return;

                const activeTab = root.__x.$data.activeTab;

                if (activeTab === 'quizzes') {
                    // نمنع الرجوع بزرار Back بعد دخول تبويب quizzes
                    history.replaceState(null, null, location.href);
                }
            });
        });
    </script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
