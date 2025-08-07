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
            <a href="{{ route('parent.dashboard') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('parent.dashboard') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <i class="fas text-2xl fa-th-large text-blue-600"></i>
                <span class="mr-2">الرئيسية</span>
            </a>

            <!-- أبنائي -->
            <a href="{{ route('parent.children') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('parent.children') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <i class="fas text-2xl fa-user-check text-blue-600"></i>
                <span class="mr-2">أبنائي</span>
            </a>

            <!-- الالعب -->
            <a href="{{ route('parent.games') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('parent.games') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <i class="fas fa-gamepad text-2xl text-blue-600"></i>
                <span class="mr-2">الالعاب</span>
            </a>


            <!-- التقارير -->
            <a href="{{ route('parent.reports') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('parent.reports') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <i class="fas fa-file-alt text-2xl text-blue-600"></i>
                <span class="mr-2">التقارير</span>
            </a>

            <!-- الإعدادات -->
            <a href="{{ route('parent.settings') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('parent.settings') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
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
