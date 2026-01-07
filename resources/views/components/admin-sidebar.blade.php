<aside class="bg-white w-64 min-h-screen shadow-lg p-4 flex flex-col justify-between"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

    <div>

        <!-- صورة الحساب -->
        <div class="mb-6 text-center">
            <img src="{{ asset('auth/rendered_page.png') }}" class="w-36 h-20 mx-auto mb-2">
        </div>

        <!-- اسم المستخدم -->
        <h2 class="text-lg font-semibold mb-6 text-center">{{ Auth::user()->name }}</h2>

        <!-- قائمة التنقل -->
        <nav class="space-y-4 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">

            <!-- الرئيسية -->
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <i class="fas text-2xl fa-th-large text-blue-600"></i>
                <span class="mx-2">{{ __('main.dashboard') }}</span>
            </a>

            <a href="{{ route('admin.students') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('admin.students') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <img src="https://img.icons8.com/ios-filled/24/176b98/student-male--v1.png" class="w-6 h-6">
                <span class="mx-2">{{ __('main.students') }}</span>
            </a>

            <a href="{{ route('admin.teachers') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->routeIs('admin.teachers') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <img src="https://img.icons8.com/ios-filled/24/176b98/teacher.png" class="w-6 h-6">
                <span class="mx-2">{{ __('main.teachers') }}</span>
            </a>

            <a href="{{ route('admin.schools.index') }}"
                class="flex items-center px-4 py-3 rounded text-base {{ request()->is('admin/schools/*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <i class="fas fa-school text-2xl text-blue-600"></i>
                <span class="mx-2">{{ __('main.schools') }}</span>
            </a>

            <a href="{{ route('admin.courses.category') }}"
                class="flex items-center px-4 py-3 rounded text-base hover:bg-gray-100">
                <i class="fa-solid fa-list text-2xl text-blue-600"></i>
                <span class="mx-2">{{ __('main.course_categories') }}</span>
            </a>

            <a href="{{ route('admin.courses.me') }}"
                class="flex items-center px-4 py-3 rounded text-base hover:bg-gray-100">
                <i class="fa-solid fa-book-open text-2xl text-blue-600"></i>
                <span class="mx-2">{{ __('main.my_courses') }}</span>
            </a>

            <a href="{{ route('admin.courses') }}"
                class="flex items-center px-4 py-3 rounded text-base hover:bg-gray-100">
                <i class="fa-solid fa-book-open text-2xl text-blue-600"></i>
                <span class="mx-2">{{ __('main.courses') }}</span>
            </a>

            <a href="{{ route('admin.projects') }}"
                class="flex items-center px-4 py-3 rounded text-base hover:bg-gray-100">
                <img src="https://img.icons8.com/ios-filled/24/176b98/project.png">
                <span class="mx-2">{{ __('main.projects') }}</span>
            </a>

            <a href="{{ route('admin.categorey') }}"
                class="flex items-center px-4 py-3 rounded text-base hover:bg-gray-100">
                <i class="fa-solid fa-list text-2xl text-blue-600"></i>
                <span class="mx-2">{{ __('main.game_categories') }}</span>
            </a>

            <a href="{{ route('admin.games.index') }}"
                class="flex items-center px-4 py-3 rounded text-base hover:bg-gray-100">
                <i class="fas fa-gamepad text-2xl text-blue-600"></i>
                <span class="mx-2">{{ __('main.games') }}</span>
            </a>

            <a href="{{ route('admin.settings.index') }}"
                class="flex items-center px-4 py-3 rounded text-base hover:bg-gray-100">
                <i class="fas fa-cog text-2xl text-blue-600"></i>
                <span class="mx-2">{{ __('main.settings') }}</span>
            </a>

            <a href="{{ route('admin.orders.index') }}"
                class="flex items-center px-4 py-3 rounded text-base hover:bg-gray-100">
                {{-- Icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-600  hover:bg-gray-100" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h18v4H3V3zm0 8h18v4H3v-4zm0 8h18v4H3v-4z" />
                </svg>
                <span class="mx-2">{{ __('main.game_orders') }}</span>
            </a>
        </nav>
    </div>

    <!-- زر تسجيل الخروج -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
            class="flex items-center w-full px-4 py-3 mt-6 bg-red-100 text-red-500 rounded text-base hover:bg-red-200">
            <i class="fas fa-sign-out-alt text-red-500"></i>
            <span class="mx-2">{{ __('main.logout') }}</span>
        </button>
    </form>
</aside>
