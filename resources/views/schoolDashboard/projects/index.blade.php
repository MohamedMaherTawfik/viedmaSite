<x-layout>

    <!-- Sidebar -->
    <x-teacher-sidebar />

    <div class="flex flex-col flex-1">
        <main class="p-6 flex-1">
            <x-teacher-header />

            <section class="bg-white p-6 rounded-xl shadow">
                <!-- عنوان وزر إنشاء تقرير -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">التقارير</h2>
                    <a href="#" class="bg-[#176b98] text-white px-5 py-2 rounded hover:bg-[#095B86FF] transition">
                        إنشاء تقرير
                    </a>
                </div>

                <!-- جدول -->
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-center ltr:text-left rtl:text-right rounded overflow-hidden">
                        <thead class="bg-gray-100 text-gray-700 font-semibold">
                            <tr>
                                <th class="p-3 text-center">اسم المعلم</th>
                                <th class="p-3 text-center">الدورة</th>
                                <th class="p-3 text-center">اسم المشروع</th>
                                <th class="p-3 text-center">الحالة</th>
                                <th class="p-3 text-center">الملاحظات</th>
                                <th class="p-3 text-center">الملف</th>
                                <th class="p-3 text-center">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($reports as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 flex items-center justify-center gap-2">
                                        <img src="https://i.pravatar.cc/40" alt="صورة"
                                            class="w-8 h-8 rounded-full object-cover">
                                        <span>{{ $item->student->name }} </span>
                                    </td>
                                    <td class="p-3 text-center"> </td>
                                    <td class="p-3 text-center"></td>
                                    <td class="p-3 text-center">
                                        <span
                                            class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            مقبول
                                        </span>
                                    </td>
                                    <td class="p-3 text-gray-500">..</td>
                                    <td class="p-3 text-center">
                                        <i class="fas fa-link text-indigo-600"></i>
                                    </td>
                                    <td class="p-3 text-center">
                                        <a href="#" class="text-gray-600 hover:text-indigo-600">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </section>


        </main>
    </div>

</x-layout>
