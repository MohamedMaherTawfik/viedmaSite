<x-layout title="لوحة تحكم ولي الأمر">

    <!-- Sidebar -->
    <x-parent-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-parent-header />
            {{-- Success Message --}}
            <x-messagesdata />

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
                    <div class="text-sm font-semibold">عدد التقييمات</div>
                    <div class="text-lg font-bold">{{ count($activites) + count($interactions) + count($behaviors) }}
                    </div>
                </div>

            </div>

            <div class="mt-8 bg-white rounded-lg shadow p-4">
                <h3 class="text-lg font-bold mb-4">آخر الأنشطة</h3>

                <table class="w-full text-sm text-right border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 border">الوصف</th>
                            <th class="p-2 border">اسم الطالب</th>
                            <th class="p-2 border">المرحلة الدراسية</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activites as $activity)
                            <tr class="text-center">
                                <td class="p-2 border">{{ $activity->description }}</td>
                                <td class="p-2 border">{{ $activity->user->name ?? '-' }}</td>
                                <td class="p-2 border">
                                    {{ $activity->user->studentMe->academicStage->name ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-2 text-center">لا توجد بيانات</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-8 bg-white rounded-lg shadow p-4">
                <h3 class="text-lg font-bold mb-4">آخر التفاعلات</h3>

                <table class="w-full text-sm text-right border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 border">الوصف</th>
                            <th class="p-2 border">اسم الطالب</th>
                            <th class="p-2 border">المرحلة الدراسية</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($interactions as $interaction)
                            <tr class="text-center">
                                <td class="p-2 border">{{ $interaction->description }}</td>
                                <td class="p-2 border">{{ $interaction->user->name ?? '-' }}</td>
                                <td class="p-2 border">
                                    {{ $interaction->user->studentMe->academicStage->name ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-2 text-center">لا توجد بيانات</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-8 bg-white rounded-lg shadow p-4 mb-10">
                <h3 class="text-lg font-bold mb-4">آخر السلوكيات</h3>

                <table class="w-full text-sm text-right border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 border">الوصف</th>
                            <th class="p-2 border">اسم الطالب</th>
                            <th class="p-2 border">المرحلة الدراسية</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($behaviors as $behavior)
                            <tr class="text-center">
                                <td class="p-2 border">{{ $behavior->description }}</td>
                                <td class="p-2 border">{{ $behavior->user->name ?? '-' }}</td>
                                <td class="p-2 border">
                                    {{ $behavior->user->studentMe->academicStage->name ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-2 text-center">لا توجد بيانات</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </main>
    </div>

</x-layout>
