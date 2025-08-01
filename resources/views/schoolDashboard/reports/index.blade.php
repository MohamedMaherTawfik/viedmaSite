<x-layout>

    <!-- Sidebar -->
    <x-teacher-sidebar />

    <div class="flex flex-col flex-1">
        <main class="p-6 flex-1">
            <x-teacher-header />

            <section class="bg-white p-6 rounded shadow">

                <!-- جدول التقارير -->
                <div class="overflow-x-auto rounded border border-gray-200">
                    <table class="min-w-full text-sm text-center rtl:text-right ltr:text-left">
                        <thead class="bg-gray-100 text-gray-700 font-semibold">
                            <tr>
                                <th class="p-3 border">ID</th>
                                <th class="p-3 border">الطالب</th>
                                <th class="p-3 border">المستخدم</th>
                                <th class="p-3 border">التقرير</th>
                                <th class="p-3 border">الملف</th>
                                <th class="p-3 border">تاريخ الإنشاء</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($reports as $report)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 border">{{ $report->id }}</td>
                                    <td class="p-3 border">{{ $report->student->name ?? '—' }}</td>
                                    <td class="p-3 border">{{ $report->user->name ?? '—' }}</td>
                                    <td class="p-3 border">{{ $report->report }}</td>
                                    <td class="p-3 border">
                                        @if ($report->file)
                                            <a href="{{ asset('storage/' . $report->file) }}" target="_blank"
                                                class="text-indigo-600 hover:underline">عرض الملف</a>
                                        @else
                                            لا يوجد ملف
                                        @endif
                                    </td>
                                    <td class="p-3 border">{{ $report->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($reports->isEmpty())
                        <div class="text-center p-4 text-gray-500">
                            لا توجد تقارير حالياً.
                        </div>
                    @endif
                </div>
            </section>


        </main>
    </div>

</x-layout>
