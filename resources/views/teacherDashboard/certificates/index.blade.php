<x-layout title="لوحه تحكم المعلم ">

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
                            <th scope="col" class="px-6 py-3 text-center">اسم الدورة</th>
                            <th scope="col" class="px-6 py-3 text-center">التاريخ</th>
                            <th scope="col" class="px-6 py-3 text-center">الحالة</th>
                            <th scope="col" class="px-6 py-3 text-center">الشهادة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($certificates as $item)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4 text-center">{{ $item->course->title }}</td>
                                <td class="px-6 py-4 text-center">
                                    {{ $item->created_at->format('d-m-Y') }}
                                </td>
                                <td class="px-6 py-4 text-center">{{ $item->status }}</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                        class="text-blue-500 hover:text-blue-800">تحميل</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

</x-layout>
