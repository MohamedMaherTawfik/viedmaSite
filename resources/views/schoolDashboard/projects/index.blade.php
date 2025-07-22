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
                    <a href="#" class="bg-[#79131d] text-white px-5 py-2 rounded hover:bg-[#5e0f18] transition">
                        إنشاء تقرير
                    </a>
                </div>

                <!-- جدول -->
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-center rtl:text-right rounded overflow-hidden">
                        <thead class="bg-gray-100 text-gray-700 font-semibold">
                            <tr>
                                <th class="p-3">الإجراءات</th>
                                <th class="p-3">الملف</th>
                                <th class="p-3">الملاحظات</th>
                                <th class="p-3">الحالة</th>
                                <th class="p-3">اسم المشروع</th>
                                <th class="p-3">الدورة</th>
                                <th class="p-3">اسم المعلم</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="p-3">
                                    <a href="#" class="text-gray-600 hover:text-indigo-600">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td class="p-3">
                                    <i class="fas fa-link text-indigo-600"></i>
                                </td>
                                <td class="p-3 text-gray-500">المشروع ممتاز ولكن بحاجة لبعض التعديلات</td>
                                <td class="p-3">
                                    <span
                                        class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">مقبول</span>
                                </td>
                                <td class="p-3">مشروع التخرج 2025</td>
                                <td class="p-3">برمجة الويب</td>
                                <td class="p-3 flex items-center justify-center gap-2">
                                    <img src="https://i.pravatar.cc/40" alt="صورة"
                                        class="w-8 h-8 rounded-full object-cover">
                                    <span>أ. محمد عبد الله</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3">
                                    <a href="#" class="text-gray-600 hover:text-indigo-600">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td class="p-3">
                                    <i class="fas fa-link text-indigo-600"></i>
                                </td>
                                <td class="p-3 text-gray-500">لم يتم تسليم التقرير بعد</td>
                                <td class="p-3">
                                    <span
                                        class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-semibold">قيد
                                        التقييم</span>
                                </td>
                                <td class="p-3">نظام الحضور الذكي</td>
                                <td class="p-3">إنترنت الأشياء</td>
                                <td class="p-3 flex items-center justify-center gap-2">
                                    <img src="https://i.pravatar.cc/41" alt="صورة"
                                        class="w-8 h-8 rounded-full object-cover">
                                    <span>أ. سارة أحمد</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>


        </main>
    </div>

</x-layout>
