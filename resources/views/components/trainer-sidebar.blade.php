<aside class="bg-white w-64 min-h-screen shadow-lg p-4 flex flex-col justify-between" dir="rtl">
    <div>
        <div class="mb-6 text-center">
            <img src="{{ asset('auth/rendered_page.png') }}" class="w-35 h-20 mx-auto mb-2">
        </div>

        <h2 class="text-lg font-semibold mb-6 text-center">{{ Auth::user()->name }}</h2>

        <nav class="space-y-4 text-right">
            <!-- الرئيسية -->
            <a href="{{ route('trainerDashboard') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('trainerDashboard') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <img src="https://img.icons8.com/ios-filled/24/176b98/home.png" alt="الرئيسية">
                <span class="mr-2">الرئيسية</span>
            </a>

            <!-- دوراتي -->
            <a href="{{ route('trainer.courses') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('trainer.courses') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <img src="https://img.icons8.com/ios-filled/24/176b98/classroom.png" alt="دوراتي">
                <span class="mr-2">دوراتي</span>
            </a>

            <!-- مشاريع المتدربين -->
            <a href="{{ route('trainer.projects') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('trainer.projects') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <img src="https://img.icons8.com/ios-filled/24/176b98/project.png" alt="مشاريع المتدربين">
                <span class="mr-2">مشاريع المتدربين</span>
            </a>

            <!-- التقييمات -->
            <a href="{{ route('trainer.evaluations') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('trainer.evaluations') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <img src="https://img.icons8.com/ios-filled/24/176b98/rating.png" alt="التقييمات">
                <span class="mr-2">التقييمات</span>
            </a>

            <!-- المواعيد -->
            <a href="{{ route('trainer.schedules') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('trainer.schedules') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <img src="https://img.icons8.com/ios-filled/24/176b98/planner.png" alt="المواعيد">
                <span class="mr-2">المواعيد</span>
            </a>

            <!-- الشهادات -->
            <a href="{{ route('trainer.certificates') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('trainer.certificates') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <img src="https://img.icons8.com/ios-filled/24/176b98/diploma.png" alt="الشهادات">
                <span class="mr-2">الشهادات</span>
            </a>
        </nav>
    </div>

    <!-- تسجيل الخروج -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
            class="flex items-center w-full px-4 py-3 mt-6 bg-red-100 text-red-500 rounded text-base hover:bg-red-200">
            <img src="https://img.icons8.com/ios-filled/24/fa314a/logout-rounded-left.png" alt="تسجيل الخروج">
            <span class="mr-2">تسجيل الخروج</span>
        </button>
    </form>
</aside>
