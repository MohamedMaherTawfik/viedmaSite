<x-layout title="{{ __('main.admin_dashboard') }}">

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

            <!-- زرار إضافة جديد -->
            <div class="mb-6 flex justify-end">
                <a href="{{ route('admin.create.Categorey') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                    {{ __('main.add_new') }}
                </a>
            </div>

            <!-- كروت عرض الكاتيجوري -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($categories as $category)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                        <!-- صورة الكاتيجوري -->
                        @if ($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                class="h-40 w-full object-cover">
                        @else
                            <div class="h-40 w-full bg-gray-200 flex items-center justify-center text-gray-500">
                                {{ __('main.no_image') }}
                            </div>
                        @endif

                        <!-- بيانات الكاتيجوري -->
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $category->name }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ $category->description }}</p>

                            <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                <a href="{{ route('admin.edit.Categorey', $category) }}"
                                    class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                    {{ __('main.edit') }}
                                </a>
                                <form action="{{ route('admin.delete.Categorey', $category) }}" method="POST"
                                    onsubmit="return confirm('{{ __('main.delete_confirm') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                        {{ __('main.delete') }}
                                    </button>
                                </form>
                            </div>


                        </div>
                    </div>
                @endforeach
            </div>

        </main>
    </div>
</x-layout>
