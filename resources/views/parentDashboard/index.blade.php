<x-layout title="لوحة تحكم ولي الأمر">

    <!-- Sidebar -->
    <x-parent-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-parent-header />
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

            <!-- Cards Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-6">

                <!-- عدد الأبناء -->
                <div class="bg-blue-100 text-blue-800 p-4 rounded-lg shadow text-center">
                    <div class="flex justify-center mb-2">
                        <i class="fas fa-user text-2xl"></i>
                    </div>
                    <div class="text-sm font-semibold">عدد الأبناء</div>
                    <div class="text-lg font-bold">{{ count(Auth::user()->student) }}</div>
                </div>

                <!-- تقييم أخير -->
                <div class="bg-yellow-200 text-yellow-800 p-4 rounded-lg shadow text-center">
                    <div class="flex justify-center mb-2">
                        <i class="fas fa-circle text-2xl"></i>
                    </div>
                    <div class="text-sm font-semibold">تقييم أخير</div>
                    <div class="text-lg font-bold"></div>
                </div>

            </div>
        </main>
    </div>

</x-layout>
