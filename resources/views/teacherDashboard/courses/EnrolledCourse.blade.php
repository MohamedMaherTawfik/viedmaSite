<x-layout title="لوحه تحكم المعلم ">

    <!-- Sidebar -->
    <x-school-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-teacher-header />
            {{-- Success Message --}}
            @if (session('success'))
                <div class="p-4 mb-4 text-green-800 bg-green-200 border border-green-300 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Fail Message --}}
            @if (session('fail'))
                <div class="p-4 mb-4 text-red-800 bg-red-200 border border-red-300 rounded">
                    {{ session('fail') }}
                </div>
            @endif

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

            <!-- Main Content Section -->
            <div class="flex flex-row-reverse gap-4">

                <!-- Column 1: Files Section (right side) -->
                <div class="w-1/3 bg-white rounded-lg shadow-md p-4">
                    <h2 class="text-xl font-bold mb-4">ملفات الدورة</h2>
                    @foreach ($course->graduationProject as $item)
                        <div class="mb-2">
                            <p>اسم المشروع: {{ $item->title }}</p>
                            <a href="{{ asset('storage/' . $item->file) }}"
                                class="text-blue-500 font-bold hover:underline">تحميل الملف</a>
                        </div>
                    @endforeach
                    <hr>
                    <div class="mt-4">
                        <button onclick="document.getElementById('uploadModal').classList.remove('hidden')"
                            class="bg-green-500 text-white px-4 py-2 mt-2 rounded hover:bg-green-600">
                            رفع المشروع
                        </button>
                    </div>
                </div>

                <!-- Column 2: Schedule Section (center) -->
                <div class="w-1/3 bg-white rounded-lg shadow-md p-4">
                    <h2 class="text-xl font-bold mb-4">جدول الدروس</h2>
                    <div class="grid grid-cols-6 gap-4">
                        @foreach ($course->sessionTime as $item)
                            <div class="col-span-3">
                                <div class="bg-gray-100 p-4 rounded-lg shadow-sm hover:shadow-md transition">
                                    <p class="text-gray-700 font-semibold">📅 اليوم: {{ $item->date }}</p>
                                    <p class="text-gray-600 mt-1">⏰ الساعه: {{ $item->time }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Column 3: Notes Section (left side) -->
                <div class="w-1/3 bg-white rounded-lg shadow-md p-4">
                    <h2 class="text-xl font-bold mb-4">الدروس</h2>
                    @foreach ($course->lessons ?? [] as $lesson)
                        <div class="mb-2">
                            <p class="text-gray-700">
                                {{ $loop->iteration }}. {{ $lesson->title }}
                            </p>
                            <span class="text-gray-500 text-sm">
                                {{ $lesson->created_at->format('Y-m-d') }}
                            </span>
                            <div>
                                <a href="{{ $lesson->video_url }}" class="text-blue-500 hover:underline text-sm"
                                    target="_blank">
                                    مشاهدة الدرس
                                </a>
                            </div>
                        </div>
                    @endforeach
                    <hr>
                    <div class="mt-4">
                    </div>
                </div>

            </div>

        </main>
    </div>
</x-layout>
