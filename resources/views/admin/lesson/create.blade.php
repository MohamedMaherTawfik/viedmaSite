<x-layout title="{{ __('main.trainer_dashboard') }}">

    <!-- Sidebar -->
    <x-admin-sidebar />

    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-admin-header />

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

            <div class="min-h-screen flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl w-full bg-white p-8 rounded-lg shadow-md">
                    <form method="POST" action="{{ route('admin.lesson.store', $course) }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Title -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">
                                    {{ __('main.lesson_title') }}
                                </label>
                                <input type="text" id="title" name="title"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                @error('title')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">
                                    {{ __('main.lesson_description') }}
                                </label>
                                <textarea id="description" name="description"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 h-32"></textarea>
                                @error('description')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Image Upload -->
                            <div class="md:col-span-2">
                                <label for="image" class="block text-sm font-medium text-gray-700">
                                    {{ __('main.lesson_image') }}
                                </label>
                                <input type="file" id="image" name="image" accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                @error('image')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Video Upload -->
                            <div class="md:col-span-2">
                                <label for="video_url" class="block text-sm font-medium text-gray-700">
                                    {{ __('main.lesson_video') }}
                                </label>
                                <input type="file" id="video_url" name="video_url" accept="video/*"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                @error('video_url')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Submit -->
                            <div class="md:col-span-2">
                                <button type="submit"
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ __('main.submit') }}
                                </button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>

        </main>
    </div>

</x-layout>
