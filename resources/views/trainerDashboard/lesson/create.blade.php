<x-layout>

    <!-- Sidebar -->
    <x-trainer-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-teacher-header />

            <h1 class="text-2xl font-bold mb-6">لوحة تحكم المدرب</h1>
            <form action="{{ route('trainer.lesson.store', $course) }}" method="POST" enctype="multipart/form-data"
                class="bg-white p-6 rounded-xl shadow-md max-w-4xl mx-auto space-y-6">
                @csrf

                <div class="grid grid-cols-1 gap-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block font-medium text-gray-700 mb-1">عنوان الدورة</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block font-medium text-gray-700 mb-1">الوصف</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Video URL -->
                    <div>
                        <label for="video_url" class="block font-medium text-gray-700 mb-1">رابط الفيديو</label>

                        <p class="text-sm text-yellow-600 bg-yellow-100 px-3 py-2 rounded mb-2">
                            يُرجى رفع الفيديو على Google Drive وضبط إعدادات المشاركة، ثم نسخ رابط المشاهدة ولصقه هنا.
                        </p>

                        <input type="url" name="video_url" id="video_url" value="{{ old('video_url') }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">

                        @error('video_url')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Cover Image -->
                    <div>
                        <label for="image" class="block font-medium text-gray-700 mb-1">صورة الغلاف</label>
                        <input type="file" name="image" id="image"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition">
                        حفظ الدورة
                    </button>
                </div>
            </form>


        </main>


    </div>

</x-layout>
