<x-layout title="لوحه تحكم المدرسه ">

    <!-- Sidebar -->
    <x-teacher-sidebar />

    <div class="flex flex-col flex-1">
        <main class="p-6 flex-1">
            <x-teacher-header />
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

            <section class="bg-white p-6 rounded shadow" x-data="{ open: false }">

                <!-- زر فتح المودال -->
                <a href="#" @click.prevent="open = true"
                    class="inline-block bg-[#176b98] hover:bg-[#115479] text-white font-medium px-4 py-2 rounded-md transition mb-4">
                    اضافه تقرير جديد
                </a>

                <!-- المودال -->
                <div x-show="open" x-transition.opacity
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                    style="display: none;">

                    <div @click.away="open = false" x-transition
                        class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative">

                        <!-- زر الإغلاق -->
                        <button @click="open = false"
                            class="absolute top-2 right-3 text-gray-500 hover:text-gray-700 text-2xl leading-none">
                            &times;
                        </button>

                        <h2 class="text-xl font-semibold text-gray-800 mb-4">إضافة تقرير جديد</h2>

                        <form action="{{ route('school.reports.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Dropdown للطلاب -->
                            <div class="mb-4">
                                <label for="student_id" class="block text-gray-700 font-medium mb-1">الطالب</label>
                                <select name="student_id" id="student_id"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#176b98]">
                                    <option value="">اختر الطالب</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- نص التقرير -->
                            <div class="mb-4">
                                <label for="report" class="block text-gray-700 font-medium mb-1">التقرير</label>
                                <textarea name="report" id="report" rows="3"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#176b98]"
                                    placeholder="اكتب التقرير هنا..."></textarea>
                            </div>

                            <!-- رفع ملف -->
                            <div class="mb-4">
                                <label for="file" class="block text-gray-700 font-medium mb-1">الملف</label>
                                <input type="file" name="file" id="file"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#176b98]">
                            </div>

                            <!-- زر الإرسال -->
                            <div class="text-right">
                                <button type="submit"
                                    class="bg-[#176b98] hover:bg-[#115479] text-white font-medium px-4 py-2 rounded-md transition">
                                    حفظ التقرير
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- جدول التقارير -->
                <div class="overflow-x-auto rounded border border-gray-200 mt-6">
                    <table class="min-w-full text-sm text-center rtl:text-right ltr:text-left">
                        <thead class="bg-gray-100 text-gray-700 font-semibold">
                            <tr>
                                <th class="p-3 border text-center">ID</th>
                                <th class="p-3 border text-center">الطالب</th>
                                <th class="p-3 border text-center">المستخدم</th>
                                <th class="p-3 border text-center">التقرير</th>
                                <th class="p-3 border text-center">الملف</th>
                                <th class="p-3 border text-center">تاريخ الإنشاء</th>
                                <th class="p-3 border text-center">الاجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($reports as $report)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 border text-center">{{ $report->id }}</td>
                                    <td class="p-3 border text-center">{{ $report->student->name ?? '—' }}</td>
                                    <td class="p-3 border text-center">{{ $report->user->name ?? '—' }}</td>
                                    <td class="p-3 border text-center">{{ $report->report }}</td>
                                    <td class="p-3 border text-center">
                                        @if ($report->file)
                                            <a href="{{ asset('storage/' . $report->file) }}" target="_blank"
                                                class="text-indigo-600 hover:underline">عرض الملف</a>
                                        @else
                                            لا يوجد ملف
                                        @endif
                                    </td>
                                    <td class="p-3 border text-center">{{ $report->created_at->format('Y-m-d') }}</td>
                                    <td class="text-center">
                                        {{-- form delete with confirmation --}}
                                        <form action="{{ route('school.reports.destroy', $report->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا التقرير؟');"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-1 transition">
                                                حذف
                                            </button>
                                        </form>

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
