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

        <h1 class="text-2xl font-bold mb-6">
            {{ __('main.trainer_dashboard') }}
        </h1>

        <!-- Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6 text-center">

            <div class="bg-blue-100 text-blue-800 rounded-lg p-4">
                <div class="text-sm font-medium">
                    {{ __('main.courses_count') }}
                </div>
                <div class="text-xl font-bold">
                    {{ count($courses) }} {{ __('main.courses') }}
                </div>
            </div>

            <div class="bg-pink-100 text-pink-800 rounded-lg p-4">
                <div class="text-sm font-medium">
                    {{ __('main.trainees_count') }}
                </div>
                <div class="text-xl font-bold">
                    {{ count($enrollments) }} {{ __('main.trainees') }}
                </div>
            </div>

            <div class="bg-orange-100 text-orange-800 rounded-lg p-4">
                <div class="text-sm font-medium">
                    {{ __('main.pending_projects') }}
                </div>
                <div class="text-xl font-bold">
                    {{ count($assignments) }} {{ __('main.projects') }}
                </div>
            </div>

            <div class="bg-green-100 text-green-800 rounded-lg p-4">
                <div class="text-sm font-medium">
                    {{ __('main.next_session') }}
                </div>
                <div class="text-xl font-bold">
                    @if (isset($latestSessionTime) && $latestSessionTime->date)
                        {{ $latestSessionTime->date }} - {{ $latestSessionTime->time ?? '' }}
                    @else
                        {{ __('main.no_session') }}
                    @endif
                </div>
            </div>

        </div>

        <!-- Notifications -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">
                    {{ __('main.latest_notifications') }}
                </h2>
                <a href="#" class="text-blue-500 hover:underline">
                    {{ __('main.view_all_notifications') }}
                </a>
            </div>

            <ul class="space-y-3">
                <li class="flex items-start gap-2">
                    <img src="https://img.icons8.com/color/24/000000/alarm.png" class="mt-1" />
                    <span>{{ __('main.notification_1') }}</span>
                </li>
                <li class="flex items-start gap-2">
                    <img src="https://img.icons8.com/color/24/000000/alarm.png" class="mt-1" />
                    <span>{{ __('main.notification_2') }}</span>
                </li>
                <li class="flex items-start gap-2">
                    <img src="https://img.icons8.com/color/24/000000/alarm.png" class="mt-1" />
                    <span>{{ __('main.notification_3') }}</span>
                </li>
                <li class="flex items-start gap-2">
                    <img src="https://img.icons8.com/color/24/000000/alarm.png" class="mt-1" />
                    <span>{{ __('main.notification_4') }}</span>
                </li>
            </ul>
        </div>

        <!-- Actions -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <a href="{{ route('trainer.courses') }}"
               class="bg-blue-500 text-white font-semibold py-3 rounded-lg flex items-center justify-center hover:bg-sky-600 transition">
                <img src="https://img.icons8.com/ios-filled/24/ffffff/classroom.png" class="ml-2" />
                {{ __('main.manage_courses') }}
            </a>

            <a href="{{ route('trainer.projects') }}"
               class="bg-sky-500 text-white font-semibold py-3 rounded-lg flex items-center justify-center hover:bg-blue-600 transition">
                <img src="https://img.icons8.com/ios-filled/24/ffffff/project.png" class="ml-2" />
                {{ __('main.review_projects') }}
            </a>

            <a href="{{ route('trainer.schedules.create') }}"
               class="bg-pink-500 text-white font-semibold py-3 rounded-lg flex items-center justify-center hover:bg-pink-600 transition">
                <img src="https://img.icons8.com/ios-filled/24/ffffff/calendar.png" class="ml-2" />
                {{ __('main.add_schedule') }}
            </a>
        </div>
    </main>
</div>


</x-layout>
