<x-layout>

    <!-- Sidebar -->
    <x-teacher-sidebar />

    <div class="flex flex-col flex-1">
        <main class="p-6 flex-1">
            <x-teacher-header />
            <section class="bg-white p-6 rounded shadow text-right space-y-8">

                <!-- القسم العلوي: تفاصيل الطالب وولي الأمر -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- الطالب -->
                    <div class="space-y-2">
                        <h2 class="text-lg font-bold">تفاصيل الطالب</h2>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div><span class="text-gray-600">الاسم الكامل:</span> {{ $student->name }}</div>
                            <div><span class="text-gray-600">الرقم القومي</span> {{ $student->national_id }}</div>
                            <div><span class="text-gray-600"> المرحله الدراسيه:</span>{{ $student->Academic_stage }}
                            </div>
                            {{-- <div><span class="text-gray-600">الصف:</span> الثاني</div> --}}
                        </div>
                    </div>
                    <!-- ولي الأمر -->
                    <div class="space-y-2">
                        <h2 class="text-lg font-bold">تفاصيل ولي الأمر</h2>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div><span class="text-gray-600">الاسم:</span>{{ $student->user->name }}</div>
                            <div><span class="text-gray-600">رقم التواصل:</span>{{ $student->user->phone }} </div>
                            <div><span class="text-gray-600">تواصل إضافي:</span>{{ $student->user->email }} </div>
                        </div>
                        <button
                            class="mt-4 px-4 py-2 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded flex items-center gap-2">
                            <i class="fas fa-pen"></i> تعديل ولي الأمر
                        </button>
                    </div>
                </div>

                <!-- المشاريع المرتبطة -->
                <div>
                    <h2 class="text-lg font-bold mb-2">المشاريع المرتبطة</h2>
                    <div class="overflow-auto">
                        <table class="min-w-full text-sm table-auto border">
                            <thead class="bg-gray-100 text-gray-700 text-right">
                                <tr>
                                    <th class="p-2">اسم المشروع</th>
                                    <th class="p-2">الحالة</th>
                                    <th class="p-2">المعلم</th>
                                    <th class="p-2">الملاحظات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t">
                                    <td class="p-2">STEM Basics</td>
                                    <td class="p-2">
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">مكتمل</span>
                                    </td>
                                    <td class="p-2">أ. سمر</td>
                                    <td class="p-2 text-gray-600">تم تقديم منتج عملي ممتاز</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="p-2">التصميم الصناعي</td>
                                    <td class="p-2">
                                        <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-xs">مرفوض</span>
                                    </td>
                                    <td class="p-2">أ. أحمد</td>
                                    <td class="p-2 text-gray-600">الموضوع غير واضح – إعادة التقديم</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ملاحظات المعلمين -->
                <div class="space-y-4">
                    <h2 class="text-lg font-bold">ملاحظات المعلمين</h2>
                    <div class="bg-green-100 text-green-700 p-3 rounded text-sm flex items-center gap-2">
                        <i class="fas fa-pen text-green-600"></i>
                        "الطالبة أظهرت اهتمامًا واضحًا في الجانب العملي، وتقدمت بشكل ملحوظ في عرض المشاريع"
                    </div>
                    <div class="bg-orange-100 text-orange-700 p-3 rounded text-sm flex items-center gap-2">
                        <i class="fas fa-pen text-orange-600"></i>
                        "يوجد ضعف بسيط في الالتزام بالمواعيد، يُنصح بمتابعة خاصة"
                    </div>
                </div>

            </section>
        </main>
    </div>

</x-layout>
