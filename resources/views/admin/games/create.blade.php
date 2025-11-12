<x-layout title="إنشاء لعبة جديدة">


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

            <form action="{{ route('admin.games.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6 bg-white p-6 rounded-2xl shadow-md">
                @csrf

                <!-- Hidden user_id -->
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                <h2 class="text-xl font-bold text-gray-800 border-b pb-2 mb-4">إضافة لعبة جديدة 🎮</h2>

                <!-- Row 1 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">عنوان اللعبة</label>
                        <input type="text" name="title"
                            class="w-full border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-lg px-3 py-2">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">الوصف</label>
                        <input type="text" name="description"
                            class="w-full border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-lg px-3 py-2">
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">السعر</label>
                        <input type="number" name="price" step="0.01"
                            class="w-full border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-lg px-3 py-2">
                        @error('price')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">تصنيف اللعبة</label>
                        <select name="games_categorey_id" id="games_categorey_id"
                            class="w-full border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-lg px-3 py-2 bg-white">
                            <option value="">-- اختر التصنيف --</option>
                            @foreach ($gamesCategorey as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('games_categorey_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Row 3 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">صورة الغلاف</label>
                        <input type="file" name="cover_image" accept="image/*"
                            class="w-full border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-lg px-3 py-2">
                        @error('cover_image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">رابط العرض الدعائي</label>
                        <input type="text" name="trailer_url"
                            class="w-full border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-lg px-3 py-2">
                        @error('trailer_url')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Row 4 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">المخزون</label>
                        <input type="number" name="stock"
                            class="w-full border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-lg px-3 py-2">
                        @error('stock')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex justify-end pt-4 border-t">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 transition text-white px-6 py-2 rounded-lg shadow">
                        💾 إنشاء اللعبة
                    </button>
                </div>
            </form>

    </div>
    </main>
    </div>

</x-layout>
