<x-layout>

    <!-- Sidebar -->
    <x-trainer-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-teacher-header />

            <h1 class="text-2xl font-bold mb-6">لوحة تحكم المدرب</h1>
            <!-- زر إضافة موعد تدريب جديد -->
            <div class="flex justify-end mb-4">
                <a href="{{ route('trainer.courses.create') }}"
                    class="border border-gray-500 text-gray-500 px-4 py-2 text-center rounded hover:bg-gray-500 hover:text-white transition">
                    إضافة دورة جديدة
                </a>
            </div>
            <div class="bg-white rounded-xl shadow p-4">
                <h2 class="text-lg font-semibold mb-4">قائمة الدورات</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-right rtl text-gray-600">
                        <thead class="bg-gray-100 text-gray-700 font-semibold">
                            <tr>
                                <th class="px-4 py-2 text-center">اسم الدورة</th>
                                <th class="px-4 py-2 text-center">الحالة</th>
                                <th class="px-4 py-2 text-center">عدد المتدربين</th>
                                <th class="px-4 py-2 text-center">تاريخ البدء</th>
                                <th class="px-4 py-2 text-center text-center">إجراء</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($courses as $item)
                                <tr>
                                    <td class="px-4 py-3 text-center">{{ $item->title }} </td>
                                    <td class="px-4 py-3 text-center">
                                        <span
                                            class="bg-orange-100 text-orange-600 px-3 py-1 text-center rounded-full text-xs">{{ $item->level }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-center">{{ count($item->enrollments) }}</td>
                                    <td class="px-4 py-3 text-center">{{ $item->start_Date }}</td>
                                    <td class="px-4 py-3 text-center text-center">
                                        <a href="{{ route('trainer.courses.show', $item->slug) }}"
                                            class="text-blue-600 hover:underline">
                                            👁️
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>


    </div>

</x-layout>
