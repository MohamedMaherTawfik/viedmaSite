<x-layout title="عرض اللعبة">

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

            <div class="bg-white shadow-lg rounded-lg p-6 max-w-3xl mx-auto mt-6">
                <!-- عنوان -->
                <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-3">{{ $game->title }}</h2>

                <!-- صورة الغلاف -->
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('storage/' . $game->cover_image) }}" alt="{{ $game->title }}"
                        class="w-128 h-40 object-cover rounded-lg shadow">
                </div>

                <!-- التفاصيل -->
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <strong>الوصف:</strong>
                        <p class="text-gray-700">{{ $game->description }}</p>
                    </div>
                    <div>
                        <strong>السعر:</strong>
                        <p class="text-gray-700">{{ $game->price }} $</p>
                    </div>
                    <div>
                        <strong>الخصم:</strong>
                        <p class="text-gray-700">{{ $game->discount }}%</p>
                    </div>
                    <div>
                        <strong>تاريخ الإصدار:</strong>
                        <p class="text-gray-700">{{ $game->release_date }}</p>
                    </div>
                    <div>
                        <strong>المطور:</strong>
                        <p class="text-gray-700">{{ $game->developer_name }}</p>
                    </div>
                    <div>
                        <strong>المنصة:</strong>
                        <p class="text-gray-700">{{ $game->platform }}</p>
                    </div>
                    <div class="col-span-2">
                        <strong>رابط العرض الدعائي:</strong>
                        <a href="{{ $game->trailer_url }}" target="_blank" class="text-blue-600 underline">مشاهدة</a>
                    </div>
                </div>

                <!-- أزرار -->
                <div class="flex justify-between items-center mt-6">
                    <a href="{{ route('admin.games.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                        رجوع
                    </a>

                    <form action="{{ route('admin.games.delete', $game) }}" method="POST"
                        onsubmit="return confirm('هل أنت متأكد من حذف هذه اللعبة؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">
                            حذف اللعبة
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>

</x-layout>
