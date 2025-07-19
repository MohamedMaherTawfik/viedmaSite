<x-layout>

    <!-- Sidebar -->
    <x-school-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-teacher-header />

            <!-- جدول الشهادات -->
            <div class="bg-white shadow rounded-lg p-4 mt-6">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-3">اسم الدورة</th>
                            <th scope="col" class="px-6 py-3">التاريخ</th>
                            <th scope="col" class="px-6 py-3">الحالة</th>
                            <th scope="col" class="px-6 py-3">الشهادة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($certificates as $item)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">{{ $item->course->name }}</td>
                                <td class="px-6 py-4">{{ $item->created_at }}</td>
                                <td class="px-6 py-4">{{ $item->status }}</td>
                                <td class="px-6 py-4">
                                    <a href="#" class="text-blue-500 hover:text-blue-800">تحميل</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

</x-layout>
