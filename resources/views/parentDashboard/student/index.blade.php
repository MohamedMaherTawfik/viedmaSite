<x-layout title="لوحة تحكم ولي الأمر">

    <!-- Sidebar -->
    <x-parent-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <main class="p-6 flex-1">
            <x-parent-header />

            <h1 class="text-2xl font-bold mb-6">بيانات الطلاب</h1>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-700 border border-gray-200">
                    <thead class="bg-gray-100 text-gray-800 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-3 text-center">الاسم</th>
                            <th class="px-4 py-3 text-center">المرحلة الدراسية</th>
                            <th class="px-4 py-3 text-center">هاتف ولي الأمر</th>
                            <th class="px-4 py-3 text-center">الجنسية</th>
                            <th class="px-4 py-3 text-center">الرقم القومي</th>
                            <th class="px-4 py-3 text-center">اسم المدرسة</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($students as $student)
                            <tr class="border-b">
                                <td class="px-4 py-3 text-center">{{ $student->name }}</td>
                                <td class="px-4 py-3 text-center">{{ $student->Academic_stage }}</td>
                                <td class="px-4 py-3 text-center">{{ $student->user->phone }}</td>
                                <td class="px-4 py-3 text-center">{{ $student->nationallity }}</td>
                                <td class="px-4 py-3 text-center">{{ $student->national_id }}</td>
                                <td class="px-4 py-3 text-center">{{ $student->school->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>

    </div>

</x-layout>
