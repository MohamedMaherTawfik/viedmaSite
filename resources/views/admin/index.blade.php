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

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

                <div class="p-6 rounded-xl text-white shadow-lg" style="background-color: #176b98;">
                    <h3 class="text-lg font-bold mb-2">{{ __('main.schools_count') }}</h3>
                    <p class="text-3xl font-extrabold">{{ $schoolsCount ?? 0 }}</p>
                </div>

                <div class="p-6 rounded-xl text-white shadow-lg" style="background-color: #FEBE35;">
                    <h3 class="text-lg font-bold mb-2">{{ __('main.teachers_count') }}</h3>
                    <p class="text-3xl font-extrabold">{{ $teachersCount ?? 0 }}</p>
                </div>

                <div class="p-6 rounded-xl text-white shadow-lg" style="background-color: #75C151;">
                    <h3 class="text-lg font-bold mb-2">{{ __('main.trainers_count') }}</h3>
                    <p class="text-3xl font-extrabold">{{ $trainersCount ?? 0 }}</p>
                </div>

                <div class="p-6 rounded-xl text-white shadow-lg" style="background-color: #374151;">
                    <h3 class="text-lg font-bold mb-2">{{ __('main.students_count') }}</h3>
                    <p class="text-3xl font-extrabold">{{ $studentsCount ?? 0 }}</p>
                </div>

                <div class="p-6 rounded-xl text-white shadow-lg" style="background-color: purple;">
                    <h3 class="text-lg font-bold mb-2">{{ __('main.parents_count') }}</h3>
                    <p class="text-3xl font-extrabold">{{ $parentsCount ?? 0 }}</p>
                </div>

                <div class="p-6 rounded-xl text-white shadow-lg" style="background-color: teal;">
                    <h3 class="text-lg font-bold mb-2">{{ __('main.game_orders_count') }}</h3>
                    <p class="text-3xl font-extrabold">{{ $orders ?? 0 }}</p>
                </div>

            </div>
        </main>

    </div>

</x-layout>
