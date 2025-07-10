<x-layout>
    @php
        $slug = request('slug');
    @endphp
    <!-- Sidebar -->
    <x-school-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-school-header />

            <div class="flex items-center justify-between bg-gray-100 p-4 rounded-lg">
                <span class="text-gray-800 text-lg">احصائيات سريعة</span>
                <button class="bg-white border rounded text-black px-4 py-2 rounded hover:bg-gray-300 transition">
                    اداره دوراتي
                </button>
            </div>

            <!-- إحصائيات سريعة -->
            <section class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 w-full">
                <!-- عدد الطلاب -->
                <div class="bg-blue-200 text-center p-4 rounded w-full">
                    <div class="text-blue-700 text-3xl mb-2">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="text-gray-800 text-sm mb-1">عدد الطلاب</div>
                    <div class="font-bold text-xl text-blue-900">
                        {{ $studentsCount }}
                    </div>
                </div>

                <!-- المعلمون -->
                <div class="bg-pink-200 text-center p-4 rounded w-full">
                    <div class="text-pink-700 text-3xl mb-2">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="text-gray-800 text-sm mb-1">المعلمون</div>
                    <div class="font-bold text-xl text-pink-900">
                        {{ $teachersCount }}
                    </div>
                </div>

                <!-- المشاريع قيد المراجعة -->
                <div class="bg-orange-100 text-center p-4 rounded w-full">
                    <div class="text-orange-500 text-3xl mb-2">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="text-gray-800 text-sm mb-1">المشاريع قيد المراجعة</div>
                    <div class="font-bold text-xl text-orange-700">
                        50
                    </div>
                </div>

                <!-- الدورات النشطة -->
                <div class="bg-green-100 text-center p-4 rounded w-full">
                    <div class="text-green-600 text-3xl mb-2">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="text-gray-800 text-sm mb-1">الدورات النشطة</div>
                    <div class="font-bold text-xl text-green-800">
                        {{ count($courses) }}
                    </div>
                </div>

                <!-- الشهادات المصدرة -->
                <div class="bg-orange-200 text-center p-4 rounded w-full">
                    <div class="text-orange-700 text-3xl mb-2">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div class="text-gray-800 text-sm mb-1">الشهادات المصدرة</div>
                    <div class="font-bold text-xl text-orange-900">
                        20
                    </div>
                </div>
            </section>


            <!-- الأنشطة الأخيرة -->
            <section class="bg-white p-4 rounded shadow mt-8 mb-6">
                <h3 class="font-semibold mb-2">الأنشطة الأخيرة</h3>
                <p>تم قبول 3 طلبات تسجيل</p>
                <p>تم إصدار 5 شهادات للمعلمين</p>
            </section>

        </main>

        <!-- أزرار التنقل السريع -->
        <section class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 p-4 bg-gray-100 mt-auto">
            <a href="{{ route('school.teachers', $slug) }}"
                class="block text-center bg-orange-400 text-white py-3 rounded font-semibold hover:bg-orange-500 transition">
                إدارة المعلمين
            </a>

            <a href="{{ route('school.enrollments', $slug) }}"
                class="block text-center bg-blue-500 text-white py-3 rounded font-semibold hover:bg-blue-600 transition">
                طلبات التسجيل
            </a>

            <a href="{{ route('school.projects', $slug) }}"
                class="block text-center bg-blue-300 text-white py-3 rounded font-semibold hover:bg-blue-400 transition">
                متابعة المشاريع
            </a>
        </section>


    </div>

</x-layout>
