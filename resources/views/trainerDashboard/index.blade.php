<x-layout>

    <!-- Sidebar -->
    <x-trainer-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-teacher-header />

            <h1 class="text-2xl font-bold mb-6">لوحة تحكم المدرب</h1>

            <!-- البطاقات -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6 text-center">
                <div class="bg-blue-100 text-blue-800 rounded-lg p-4">
                    <div class="text-sm font-medium">عدد الدورات التدريبية</div>
                    <div class="text-xl font-bold">{{ count($courses) }} دورات</div>
                </div>
                <div class="bg-pink-100 text-pink-800 rounded-lg p-4">
                    <div class="text-sm font-medium">عدد المتدربين</div>
                    <div class="text-xl font-bold">{{ count($enrollments) }} متدرب</div>
                </div>
                <div class="bg-orange-100 text-orange-800 rounded-lg p-4">
                    <div class="text-sm font-medium">مشاريع قيد التقييم</div>
                    <div class="text-xl font-bold">{{ count($assignments) }} مشاريع</div>
                </div>
                <div class="bg-green-100 text-green-800 rounded-lg p-4">
                    <div class="text-sm font-medium">أقرب جلسة تدريب</div>
                    <div class="text-xl font-bold">
                        @if (isset($latestSessionTime) && $latestSessionTime->date)
                            {{ $latestSessionTime->date }} -
                            {{ $latestSessionTime->time ?? '' }}
                        @else
                            لم يتم تحديد ميعاد
                        @endif
                    </div>

                </div>
            </div>

            <!-- التنبيهات -->
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold">📣 أحدث التنبيهات</h2>
                    <a href="#" class="text-blue-500 hover:underline">عرض جميع التنبيهات</a>
                </div>

                <ul class="space-y-3">
                    <li class="flex items-start gap-2">
                        <img src="https://img.icons8.com/color/24/000000/alarm.png" class="mt-1" />
                        <span>تم رفع مشروع جديد من المعلم أحمد محمود</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <img src="https://img.icons8.com/color/24/000000/alarm.png" class="mt-1" />
                        <span>الدورة "STEM Basics" ستنتهي خلال 3 أيام</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <img src="https://img.icons8.com/color/24/000000/alarm.png" class="mt-1" />
                        <span>يوجد تقييم غير مكتمل لـ أحمد سامي</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <img src="https://img.icons8.com/color/24/000000/alarm.png" class="mt-1" />
                        <span>تم إصدار شهادة لمعلم في دورة التفكير النقدي</span>
                    </li>
                </ul>
            </div>

            <!-- الأزرار -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <a href="{{ route('trainer.courses') }}"
                    class="bg-blue-500 text-white font-semibold py-3 rounded-lg flex items-center justify-center hover:bg-sky-600 transition">
                    <img src="https://img.icons8.com/ios-filled/24/ffffff/classroom.png" class="ml-2" />
                    إدارة دوراتي
                </a>
                <a href="{{ route('trainer.projects') }}"
                    class="bg-sky-500 text-white font-semibold py-3 rounded-lg flex items-center justify-center hover:bg-blue-600 transition">
                    <img src="https://img.icons8.com/ios-filled/24/ffffff/project.png" class="ml-2" />
                    راجع المشاريع
                </a>
                <a href="{{ route('trainer.schedules.create') }}"
                    class="bg-pink-500 text-white font-semibold py-3 rounded-lg flex items-center justify-center hover:bg-pink-600 transition">
                    <img src="https://img.icons8.com/ios-filled/24/ffffff/calendar.png" class="ml-2" />
                    أضف موعد تدريب
                </a>


            </div>
        </main>


    </div>

</x-layout>
