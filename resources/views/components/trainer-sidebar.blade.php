<aside class="bg-white w-64 min-h-screen shadow-lg p-4 flex flex-col justify-between"
    dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

    <div>
        <div class="mb-6 text-center">
            <img src="{{ asset('auth/rendered_page.png') }}" class="w-35 h-20 mx-auto mb-2">
        </div>

        <h2 class="text-lg font-semibold mb-6 text-center">
            {{ Auth::user()->name }}
        </h2>

        <nav class="space-y-4 text-right">

            <!-- Dashboard -->
            <a href="{{ route('trainerDashboard') }}"
                class="flex items-center px-4 py-3 rounded text-base
               {{ request()->routeIs('trainerDashboard') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <img src="https://img.icons8.com/ios-filled/24/176b98/home.png">
                <span class="mr-2">{{ __('main.dashboard') }}</span>
            </a>

            <!-- Courses -->
            <a href="{{ route('trainer.courses') }}"
                class="flex items-center px-4 py-3 rounded text-base
               {{ request()->routeIs('trainer.courses') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <img src="https://img.icons8.com/ios-filled/24/176b98/classroom.png">
                <span class="mr-2">{{ __('main.courses') }}</span>
            </a>

            <!-- Projects -->
            <a href="{{ route('trainer.projects') }}"
                class="flex items-center px-4 py-3 rounded text-base
               {{ request()->routeIs('trainer.projects') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <img src="https://img.icons8.com/ios-filled/24/176b98/project.png">
                <span class="mr-2">{{ __('main.trainee_projects') }}</span>
            </a>

            <!-- Students -->
            <a href="{{ route('teacher.students') }}"
                class="flex items-center px-4 py-3 rounded text-base
               {{ request()->routeIs('teacher.students') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <img src="https://img.icons8.com/ios-filled/24/176b98/student-male--v1.png" class="w-6 h-6">
                <span class="mr-2">{{ __('main.students') }}</span>
            </a>

            <!-- Schedules -->
            <a href="{{ route('trainer.schedules') }}"
                class="flex items-center px-4 py-3 rounded text-base
               {{ request()->routeIs('trainer.schedules') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <img src="https://img.icons8.com/ios-filled/24/176b98/planner.png">
                <span class="mr-2">{{ __('main.schedules') }}</span>
            </a>

            <!-- Certificates -->
            <a href="{{ route('trainer.certificates') }}"
                class="flex items-center px-4 py-3 rounded text-base
               {{ request()->routeIs('trainer.certificates') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                <img src="https://img.icons8.com/ios-filled/24/176b98/diploma.png">
                <span class="mr-2">{{ __('main.certificates') }}</span>
            </a>

            <a href="{{ route('teacher.honors') }}"
                class="flex items-center gap-2 px-4 py-3 rounded text-base
                {{ request()->routeIs('teacher.honors') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">

                <img src="https://img.icons8.com/ios-filled/24/176b98/star.png" alt="Honors">
                <span>{{ __('main.honors') }}</span>
            </a>



        </nav>
    </div>

    <!-- Logout -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
            class="flex items-center w-full px-4 py-3 mt-6 bg-red-100 text-red-500 rounded text-base hover:bg-red-200">
            <img src="https://img.icons8.com/ios-filled/24/fa314a/logout-rounded-left.png">
            <span class="mr-2">{{ __('main.logout') }}</span>
        </button>
    </form>
</aside>
