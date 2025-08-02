<x-layout title="لوحة تحكم ولي الأمر">

    <!-- Sidebar -->
    <x-parent-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-parent-header />

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
                    <div class="text-lg font-bold">{{ }}</div>
                </div>

            </div>
        </main>
    </div>

</x-layout>
