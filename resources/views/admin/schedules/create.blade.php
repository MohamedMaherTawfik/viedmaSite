<x-layout title="{{ __('main.trainer_dashboard') }}">

    <!-- Sidebar -->
    <x-admin-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-admin-header />

            <h1 class="text-2xl font-bold mb-6">{{ __('main.trainer_dashboard') }}</h1>

            <!-- Form Container -->
            <div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto">
                <h2 class="text-xl font-bold mb-4 text-center">{{ __('main.add_new_training_schedule') }}</h2>

                <form action="{{ route('admin.schedules.store') }}" method="POST">
                    @csrf

                    <!-- Course Dropdown -->
                    <div class="mb-4">
                        <label for="course_id" class="block text-gray-700 font-medium mb-2">{{ __('main.course_name') }}</label>
                        <select id="course_id" name="courses_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            <option value="">{{ __('main.select_course') }}</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>

                        @error('courses_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Date Input -->
                    <div class="mb-4 flex space-x-2">
                        <div class="flex-1">
                            <label for="date" class="block text-gray-700 font-medium mb-2">{{ __('main.date') }}</label>
                            <div class="relative">
                                <input type="date" id="date" name="date"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            </div>
                        </div>
                        @error('date')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Time Input -->
                    <div class="mb-4 flex space-x-2">
                        <div class="flex-1">
                            <label for="time" class="block text-gray-700 font-medium mb-2">{{ __('main.time') }}</label>
                            <div class="relative">
                                <input type="time" id="time" name="time"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            </div>
                        </div>
                        @error('time')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">{{ __('main.add_schedule') }}</button>
                    </div>
                </form>

            </div>
        </main>

    </div>

</x-layout>
