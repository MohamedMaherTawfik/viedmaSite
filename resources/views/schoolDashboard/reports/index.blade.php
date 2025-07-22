<x-layout>

    <!-- Sidebar -->
    <x-teacher-sidebar />

    <div class="flex flex-col flex-1">
        <main class="p-6 flex-1">
            <x-teacher-header />

            {{-- <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">التقارير</h2>
                <div class="flex gap-2">
                    <a href="{{ route('school.reports.create', request('slug')) }}"
                        class="border border-gray-500 text-gray-500 px-4 py-2 rounded hover:bg-gray-500 hover:text-white transition">
                        إضافة تقرير
                    </a>
                </div>
            </div> --}}

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
                                <th class="p-3 border">إجراءات</th>
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
                                            —
                                        @endif
                                    </td>
                                    <td class="p-3 border">{{ $report->created_at->format('Y-m-d') }}</td>
                                    <td class="p-3 border">
                                        <a href="{{ route('reports.show', $report->id) }}"
                                            class="text-blue-600 hover:underline">عرض</a>
                                    </td>
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
