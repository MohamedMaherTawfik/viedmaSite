<aside class="bg-white w-64 min-h-screen shadow-lg p-4 flex flex-col justify-between" dir="rtl">
    <div>
        <!-- صورة الحساب -->
        <div class="mb-6 text-center">
            <img src="{{ asset('auth/rendered_page.png') }}" class="w-36 h-20 mx-auto mb-2">
        </div>

        <!-- اسم المستخدم -->
        <h2 class="text-lg font-semibold mb-6 text-center">{{ Auth::user()->name }}</h2>

        <!-- قائمة التنقل -->
        <nav class="space-y-4 text-right">
            <!-- الرئيسية -->
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <i class="fas text-2xl fa-th-large text-blue-600"></i>
                <span class="mr-2">الرئيسية</span>
            </a>

            <!-- المدارس -->
            <a href="{{ route('admin.schools.index') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('admin.schools.index') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <i class="fas fa-school text-2xl text-blue-600"></i>

                <span class="mr-2">المدارس</span>
            </a>

            <!-- الالعب -->
            <a href="{{ route('admin.games.index') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('admin.games.index') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <i class="fas fa-gamepad text-2xl text-blue-600"></i>
                <span class="mr-2">الالعاب</span>
            </a>

            <!-- الإعدادات -->
            <a href="{{ route('admin.settings.index') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('admin.settings.index') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <i class="fas text-2xl fa-cog text-blue-600"></i>
                <span class="mr-2">الإعدادات</span>
            </a>
        </nav>
    </div>

    <!-- زر تسجيل الخروج -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
            class="flex items-center w-full px-4 py-3 mt-6 bg-red-100 text-red-500 rounded text-base hover:bg-red-200">
            <i class="fas text-2xl fa-sign-out-alt text-red-500"></i>
            <span class="mr-2">تسجيل الخروج</span>
        </button>
    </form>
</aside>
