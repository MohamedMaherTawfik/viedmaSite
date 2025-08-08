<aside class="bg-white w-64 min-h-screen shadow-lg p-4 flex flex-col justify-between" dir="ltr">
    <div>
        <div class="mb-6 text-center">
            <img src="{{ asset('auth/rendered_page.png') }}" class="w-35 h-20 mx-auto mb-2">
        </div>

        <h2 class="text-lg font-semibold mb-6 text-center">{{ Auth::user()->name }}</h2>

        <nav class="space-y-4 text-left">
            <!-- الرئيسية -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <img src="https://img.icons8.com/ios-filled/24/176b98/home.png" alt="الرئيسية">
                <span class="ml-2">الرئيسية</span>
            </a>

            <!-- دوراتي -->
            <a href="{{ route('teacher.courses') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('teacher.courses') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <img src="https://img.icons8.com/ios-filled/24/176b98/classroom.png" alt="دوراتي">
                <span class="ml-2">دوراتي</span>
            </a>

            <!-- الشهادات -->
            <a href="{{ route('teacher.certificates') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('teacher.certificates') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <img src="https://img.icons8.com/ios-filled/24/176b98/diploma.png" alt="الشهادات">
                <span class="ml-2">الشهادات</span>
            </a>

            <!-- المشاريع -->
            <a href="{{ route('teacher.projects') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('teacher.projects') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <img src="https://img.icons8.com/ios-filled/24/176b98/project.png" alt="المشاريع">
                <span class="ml-2">المشاريع</span>
            </a>

            {{-- جميع الطلاب --}}
            <a href="{{ route('teacher.students') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('teacher.students') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <img src="https://img.icons8.com/ios-filled/24/176b98/student-male--v1.png" alt="الطلاب"
                    class="w-6 h-6">
                <span class="ml-2">جميع الطلاب</span>
            </a>
            <!-- تقييم الطلاب -->
            <form action="{{ route('logout') }}" method="POST" class="mt-6">
                @csrf
                <button type="submit"
                    class="flex items-center px-4 py-3 bg-red-100 text-red-500 rounded text-base w-full">
                    <img src="https://img.icons8.com/ios-filled/24/fa314a/logout-rounded-left.png" alt="تسجيل الخروج">
                    <span class="ml-2">تسجيل الخروج</span>
                </button>
            </form>

        </nav>
    </div>

    <!-- تسجيل الخروج -->

</aside>
