<x-layout title="لوحه تحكم المعلم ">

    <!-- Sidebar -->
    <x-school-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-teacher-header />

            <!-- Main Content Section -->
            <div class="flex flex-row-reverse gap-4">

                <!-- Column 1: Files Section (on the right) -->
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
                        <!-- الزر لفتح المودال -->
                        <div class="mt-4">
                            <button onclick="document.getElementById('uploadModal').classList.remove('hidden')"
                                class="bg-green-500 text-white px-4 py-2 mt-2 rounded hover:bg-green-600">
                                رفع المشروع
                            </button>
                        </div>

                        <!-- Modal -->
                        <div id="uploadModal"
                            class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
                            <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative">
                                <!-- Close button -->
                                <button onclick="document.getElementById('uploadModal').classList.add('hidden')"
                                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>

                                <h2 class="text-xl font-semibold mb-4">رفع المشروع</h2>

                                <!-- نموذج رفع المشروع -->
                                <form action="{{ route('teacher.project.upload', 'course') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium mb-1"> feedback </label>
                                        <input type="text" name="feedback" class="w-full border rounded px-3 py-2"
                                            required>
                                        @error('feedback')
                                            <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium mb-1">ملف المشروع</label>
                                        <input type="file" name="file" class="w-full border rounded px-3 py-2"
                                            required>
                                        @error('file')
                                            <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="graduation_project_id" class="block text-sm font-medium mb-1">اختر
                                            مشروع
                                            التخرج:</label>
                                        <select name="graduation_project_id" id="project_id"
                                            class="w-full border rounded px-3 py-2" required>
                                            <option value="">-- اختر مشروعاً --</option>
                                            @foreach ($course->graduationProject as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('graduation_project_id')
                                            <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                    <div class="flex justify-end">
                                        <button type="submit"
                                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">رفع</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- Column 2: Schedule Section (center) -->
                <div class="w-2/3 bg-white rounded-lg shadow-md p-4">
                    <h2 class="text-xl font-bold mb-4">جدول الدروس</h2>
                    <div class="flex justify-between items-center mb-4">
                    </div>
                    <div class="grid grid-cols-6 gap-4">
                        <!-- Monday -->
                        <div class="col-span-1">
                            <div class="bg-gray-200 p-2 rounded">
                                @foreach ($course->sessionTime as $item)
                                    <p class="text-gray-600">اليوم: {{ $item->date }}</p>
                                    <p class="text-gray-600 mx-2">الساعه: {{ $item->time }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</x-layout>
