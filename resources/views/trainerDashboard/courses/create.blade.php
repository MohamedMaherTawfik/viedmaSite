<x-layout title="لوحه تحكم المدرب ">

    <!-- Sidebar -->
    <x-trainer-sidebar />

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

            <h1 class="text-2xl font-bold mb-6">لوحة تحكم المدرب</h1>
            <form action="{{ route('trainer.courses.store') }}" method="POST" enctype="multipart/form-data"
                class="bg-white p-6 rounded-xl shadow-md max-w-4xl mx-auto space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block font-medium text-gray-700 mb-1">عنوان الدورة</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Level -->
                    <div>
                        <label for="level" class="block font-medium text-gray-700 mb-1">المستوى</label>
                        <select name="level" id="level"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">
                            <option value="">اختر المستوى</option>
                            <option value="Beginner" {{ old('level') == 'مبتدئ' ? 'selected' : '' }}>مبتدئ</option>
                            <option value="Mid" {{ old('level') == 'متوسط' ? 'selected' : '' }}>متوسط</option>
                            <option value="Advanced" {{ old('level') == 'متقدم' ? 'selected' : '' }}>متقدم</option>
                        </select>
                        @error('level')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Start Date -->
                    <div>
                        <label for="start_Date" class="block font-medium text-gray-700 mb-1">تاريخ البدء</label>
                        <input type="date" name="start_Date" id="start_Date" value="{{ old('start_Date') }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">
                        @error('start_Date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Duration -->
                    <div>
                        <label for="duration" class="block font-medium text-gray-700 mb-1">المدة (بالساعات)</label>
                        <input type="number" name="duration" id="duration" value="{{ old('duration') }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">
                        @error('duration')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block font-medium text-gray-700 mb-1">الحالة</label>
                        <select name="status" id="status"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">
                            <option value="">اختر الحالة</option>
                            <option value="نشط" {{ old('status') == 'نشط' ? 'selected' : '' }}>نشط</option>
                            <option value="غير نشط" {{ old('status') == 'غير نشط' ? 'selected' : '' }}>غير نشط</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block font-medium text-gray-700 mb-1">السعر (جنيه)</label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Cover Photo -->
                    <div class="md:col-span-2">
                        <label for="cover_photo" class="block font-medium text-gray-700 mb-1">صورة الغلاف</label>
                        <input type="file" name="cover_photo" id="cover_photo"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">
                        @error('cover_photo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description (Full width) -->
                    <div class="md:col-span-2">
                        <label for="description" class="block font-medium text-gray-700 mb-1">الوصف</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">{{ old('description') }}</textarea>
                        @error('description')
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
