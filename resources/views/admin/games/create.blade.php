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

            <div class="bg-white shadow-lg rounded-lg p-6 max-w-4xl mx-auto mt-6">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-3">إنشاء لعبة جديدة</h2>

                <form action="{{ route('admin.games.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf

                    <!-- Hidden user_id -->
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <!-- Row 1 -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1 font-medium text-gray-700">عنوان اللعبة</label>
                            <input type="text" name="title" class="w-full border rounded-lg px-3 py-2">
                            @error('title')
                                <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1 font-medium text-gray-700">الوصف</label>
                            <input type="text" name="description" class="w-full border rounded-lg px-3 py-2">
                            @error('description')
                                <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Row 2 -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1 font-medium text-gray-700">السعر</label>
                            <input type="number" name="price" step="0.01"
                                class="w-full border rounded-lg px-3 py-2">
                            @error('price')
                                <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1 font-medium text-gray-700">الخصم</label>
                            <input type="number" name="discount" step="0.01"
                                class="w-full border rounded-lg px-3 py-2">
                            @error('discount')
                                <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Row 3 -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1 font-medium text-gray-700">تاريخ الإصدار</label>
                            <input type="date" name="release_date" class="w-full border rounded-lg px-3 py-2">
                            @error('release_date')
                                <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1 font-medium text-gray-700">اسم المطور</label>
                            <input type="text" name="developer_name" class="w-full border rounded-lg px-3 py-2">
                            @error('developer_name')
                                <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Row 4 -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1 font-medium text-gray-700">صورة الغلاف</label>
                            <input type="file" name="cover_image" accept="image/*"
                                class="w-full border rounded-lg px-3 py-2">
                            @error('cover_image')
                                <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1 font-medium text-gray-700">المنصة</label>
                            <input type="text" name="platform" class="w-full border rounded-lg px-3 py-2">
                            @error('platform')
                                <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Row 5 -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1 font-medium text-gray-700">رابط العرض الدعائي</label>
                            <input type="text" name="trailer_url" class="w-full border rounded-lg px-3 py-2">
                            @error('trailer_url')
                                <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1 font-medium text-gray-700">المخزون</label>
                            <input type="number" name="stock" class="w-full border rounded-lg px-3 py-2">
                            @error('stock')
                                <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                            إنشاء اللعبة
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

</x-layout>
