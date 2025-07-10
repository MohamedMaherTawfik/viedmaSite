@php
    $slug = request('slug');
@endphp

@php
    $slug = request('slug');
@endphp

<aside class="bg-white w-64 min-h-screen shadow-lg p-4 flex flex-col justify-between">
    <div>
        <div class="mb-6 text-center">
            <img src="{{ asset('auth/rendered_page.png') }}" class="w-35 h-20 mx-auto mb-2">
        </div>

        <h2 class="text-sm font-semibold mb-4 text-center">مدرسة النور الخاصة</h2>

        <nav class="space-y-2">
            <a href="{{ route('school.dashboard', $slug) }}"
                class="block text-right px-4 py-2 rounded {{ request()->routeIs('school.dashboard') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                الرئيسية
            </a>

            <a href="{{ route('school.teachers', $slug) }}"
                class="block text-right px-4 py-2 rounded {{ request()->routeIs('school.teachers') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                إدارة المعلمين
            </a>

            <a href="{{ route('school.students', $slug) }}"
                class="block text-right px-4 py-2 rounded {{ request()->routeIs('school.students') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                إدارة الطلاب
            </a>

            <a href="{{ route('school.training', $slug) }}"
                class="block text-right px-4 py-2 rounded {{ request()->routeIs('school.training') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                متابعة التدريب
            </a>

            <a href="{{ route('school.projects', $slug) }}"
                class="block text-right px-4 py-2 rounded {{ request()->routeIs('school.projects') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                متابعة المشاريع
            </a>

            <a href="{{ route('school.enrollments', $slug) }}"
                class="block text-right px-4 py-2 rounded {{ request()->routeIs('school.enrollments') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                طلبات التسجيل
            </a>

            <a href="{{ route('school.reports', $slug) }}"
                class="block text-right px-4 py-2 rounded {{ request()->routeIs('school.reports') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                التقارير
            </a>

            <a href="{{ route('school.settings', $slug) }}"
                class="block text-right px-4 py-2 rounded {{ request()->routeIs('school.settings') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
                الإعدادات
            </a>
        </nav>
    </div>

    <a href="{{ route('school.logout') }}" class="block text-right px-4 py-2 mt-4 bg-red-100 text-red-500 rounded">
        تسجيل الخروج
    </a>
</aside>
