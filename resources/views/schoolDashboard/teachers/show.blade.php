<x-layout>

    <!-- Sidebar -->
    <x-school-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-school-header />

            <section dir="rtl" class="p-6 bg-gray-50 min-h-screen font-[Cairo]">
                <div class="max-w-6xl mx-auto bg-white shadow rounded-xl p-6">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <img src="https://th.bing.com/th/id/R.4b6a7d8dc6ff6bd305a872c783d2f450?rik=IcLvZ3InG%2bn33g&pid=ImgRaw&r=0"
                                class="w-16 h-16 rounded-full border-2 border-white shadow" alt="Teacher Photo">
                            <h2 class="text-xl font-bold text-gray-800">تفاصيل المعلم</h2>
                        </div>
                        <div class="flex gap-2">
                            <a href="#"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">إرسال إشعار /
                                ملاحظة</a>
                            <a href="#"
                                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">تحميل تقرير
                                المعلم PDF</a>
                        </div>
                    </div>

                    <!-- Teacher Info -->
                    <div class="grid grid-cols-2 gap-4 text-sm mb-8">
                        <div class="space-y-2">
                            <div>الاسم الكامل</div>
                            <input value="{{ $teacher->name }}" class="w-full border rounded px-3 py-2 bg-gray-100"
                                disabled>
                        </div>
                        <div class="space-y-2">
                            <div>البريد الإلكتروني</div>
                            <input value="{{ $teacher->email }}" class="w-full border rounded px-3 py-2 bg-gray-100"
                                disabled>
                        </div>
                        <div class="space-y-2">
                            <div>رقم الجوال</div>
                            <input value="{{ $teacher->applyTeacher->phone }}"
                                class="w-full border rounded px-3 py-2 bg-gray-100" disabled>
                        </div>
                        <div class="space-y-2">
                            <div> المقرر الدراسي</div>
                            <input value="{{ $teacher->applyTeacher->topic }}"
                                class="w-full border rounded px-3 py-2 bg-gray-100" disabled>
                        </div>
                        <div class="space-y-2">
                            <div>الحاله</div>
                            <input value="{{ $teacher->applyTeacher->status }}"
                                class="w-full border border-green-500 text-green-600 font-semibold rounded px-3 py-2 bg-green-50"
                                disabled>
                        </div>
                        <div class="space-y-2">
                            <div>تاريخ التسجيل</div>
                            <input value="{{ $teacher->created_at->format('d F Y') }}"
                                class="w-full border rounded px-3 py-2 bg-gray-100" disabled>
                        </div>
                    </div>

                    @if ($teacher->applyTeacher->status === 'accepted')
                        <!-- Current Courses -->
                        <div class="mb-8">
                            <h3 class="text-lg font-bold mb-2">الدورات الحالية</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm border-separate border-spacing-y-2 text-right">
                                    <thead class="bg-gray-100 text-gray-700">
                                        <tr>
                                            <th class="px-4 py-2 rounded-r-lg">الدورة</th>
                                            <th class="px-4 py-2 rounded-r-lg">عدد الساعات</th>
                                            <th class="px-4 py-2 rounded-r-lg">المرحله</th>
                                            <th class="px-4 py-2">تفاصيل الدورة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teacher->course as $item)
                                            <tr class="bg-white shadow rounded-lg">
                                                <td class="px-4 py-2">{{ $item->title }} </td>
                                                <td class="px-4 py-2 text-red-600">{{ $item->duration }}</td>
                                                <td class="px-4 py-2 text-green-600">{{ $item->level }}</td>
                                                <td class="px-4 py-2 text-blue-500"><a href="#">عرض</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Uploaded Projects -->
                        <div class="mb-8">
                            <h3 class="text-lg font-bold mb-2">المشاريع المرفوعة</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm border-separate border-spacing-y-2 text-right">
                                    <thead class="bg-gray-100 text-gray-700">
                                        <tr>
                                            <th class="px-4 py-2 rounded-r-lg">الاسم</th>
                                            <th class="px-4 py-2">الحالة</th>
                                            <th class="px-4 py-2">المحتوى</th>
                                            {{-- <th class="px-4 py-2">الدورة</th> --}}
                                            <th class="px-4 py-2">تفاصيل المشروع</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teacher->graduationProjects as $item)
                                            <tr class="bg-white shadow rounded-lg">
                                                <td class="px-4 py-2"> {{ $item->title }}</td>
                                                <td class="px-4 py-2 text-orange-500">{{ $item->status }}</td>
                                                <td class="px-4 py-2">{{ $item->file }}</td>
                                                {{-- <td class="px-4 py-2">{{$item->}}</td> --}}
                                                <td class="px-4 py-2 text-blue-500"><a href="#">عرض</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Teacher Ratings -->
                        <div class="mb-8">
                            <h3 class="text-lg font-bold mb-2">تقييمات المعلم</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm border-separate border-spacing-y-2 text-right">
                                    <thead class="bg-gray-100 text-gray-700">
                                        <tr>
                                            <th class="px-4 py-2 rounded-r-lg">اسم المقيم</th>
                                            <th class="px-4 py-2">التاريخ</th>
                                            <th class="px-4 py-2">التقييم</th>
                                            <th class="px-4 py-2">منطقة التقييم</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-white shadow rounded-lg">
                                            <td class="px-4 py-2">أ. أحمد صلاح</td>
                                            <td class="px-4 py-2">12 يوليو 2025</td>
                                            <td class="px-4 py-2 text-green-600">جيدة جدًا</td>
                                            <td class="px-4 py-2">نشاط STEM</td>
                                        </tr>
                                        <tr class="bg-white shadow rounded-lg">
                                            <td class="px-4 py-2">أ. يوسف إسماعيل</td>
                                            <td class="px-4 py-2">12 يوليو 2025</td>
                                            <td class="px-4 py-2 text-green-600">ممتاز</td>
                                            <td class="px-4 py-2">STEM Basics</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- General Status -->
                        <div class="bg-gray-100 border border-dashed rounded-lg p-4 text-sm">
                            <p class="mb-2">✅ الدورات المتاحة للمعلم فقط ومشارك في <span
                                    class="font-semibold text-green-600">2 دورة</span></p>
                            <p class="mb-2">📚 عدد الشهادات المكتسبة: <span class="font-semibold">1</span></p>
                            <p class="mb-2">📅 آخر دخول للنظام في <span class="font-semibold text-blue-600">10 مايو
                                    2025</span></p>
                            <p>❗آخر اختبار لم يتم إرساله لأنه "تم قبول مشروعات التدريب"</p>
                        </div>
                    @else
                        <div class="flex justify-center items-center">
                            <div class="bg-white shadow-xl rounded-2xl p-6 w-full max-w-sm text-center space-y-4">
                                <h2 class="text-xl font-semibold text-gray-800">هل تريد قبول أو رفض الطلب؟</h2>

                                <div class="flex justify-center gap-4">
                                    <a href="{{ route('school.teachers.accept', ['slug' => request('slug'), 'name' => request('name')]) }}"
                                        class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                                        قبول
                                    </a>
                                    <a href="{{ route('school.teachers.reject', ['slug' => request('slug'), 'name' => request('name')]) }}"
                                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                        رفض
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </section>

        </main>

    </div>

    <script>
        //
    </script>
</x-layout>
