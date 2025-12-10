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
            <h2 class="text-2xl font-bold mb-6 text-gray-800">
                {{ __('main.edit_category') }} {{ $categorey->name }}
            </h2>

            <form action="{{ route('admin.update.Categorey', $categorey) }}" method="POST" enctype="multipart/form-data"
                class="space-y-5">
                @csrf

                <!-- الاسم -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">{{ __('main.name') }}</label>
                    <input type="text" id="name" name="name"
                        class="mt-1 block w-full rounded-lg border border-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        value="{{ $categorey->name }}">
                </div>

                <!-- الوصف -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">{{ __('main.description') }}</label>
                    <input type="text" id="description" name="description" rows="3"
                        class="mt-1 block w-full rounded-lg border border-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        value="{{ $categorey->description }}" />
                </div>

                <!-- الصورة -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">{{ __('main.image') }}</label>
                    <input type="file" id="image" name="image"
                        class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4
                                      file:rounded-lg file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-blue-50 file:text-blue-700
                                      hover:file:bg-blue-100">
                </div>

                {{-- {{ $categorey->image --}}
                <img src="{{ asset('storage/' . $categorey->image) }}" alt="{{ $categorey->name }}" class="w-32 h-32">

                <!-- زرار -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 transition">
                        {{ __('main.save_category') }}
                    </button>
                </div>
            </form>
        </main>
    </div>
</x-layout>
