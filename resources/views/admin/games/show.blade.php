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

            <div class="bg-white shadow-xl rounded-2xl p-8 max-w-4xl mx-auto mt-10">
                <!-- عنوان -->
                <h2 class="text-3xl font-extrabold mb-8 text-gray-800 border-b-2 border-gray-200 pb-4 text-center">
                    {{ $game->title }}
                </h2>

                <!-- صورة الغلاف -->
                <div class="flex justify-center mb-8">
                    <img src="{{ $game->cover_image
                        ? asset('storage/' . $game->cover_image)
                        : 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=' }}"
                        alt="{{ $game->name ?? 'Game Image' }}"
                        class="w-full max-w-lg h-64 object-cover rounded-xl shadow-md border border-gray-200">
                </div>

                <!-- التفاصيل -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-base text-gray-700">
                    <div>
                        <strong class="block text-gray-900 mb-1">الوصف:</strong>
                        <p>{{ $game->description }}</p>
                    </div>
                    <div>
                        <strong class="block text-gray-900 mb-1">السعر:</strong>
                        <p class="font-semibold text-green-600">{{ $game->price }} $</p>
                    </div>
                    <div>
                        <strong class="block text-gray-900 mb-1">الخصم:</strong>
                        <p class="text-red-600">{{ $game->discount }}%</p>
                    </div>
                    <div>
                        <strong class="block text-gray-900 mb-1">تاريخ الإصدار:</strong>
                        <p>{{ $game->release_date }}</p>
                    </div>

                </div>

                <!-- أزرار -->
                <div class="flex flex-col md:flex-row justify-between items-center mt-10 gap-4">
                    <a href="{{ route('admin.games.index') }}"
                        class="w-full md:w-auto text-center bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg shadow-md transition">
                        رجوع
                    </a>

                    <form action="{{ route('admin.games.delete', $game) }}" method="POST"
                        onsubmit="return confirm('هل أنت متأكد من حذف هذه اللعبة؟');" class="w-full md:w-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full md:w-auto bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg shadow-md transition">
                            حذف اللعبة
                        </button>
                    </form>
                </div>
            </div>

        </main>
    </div>

</x-layout>
