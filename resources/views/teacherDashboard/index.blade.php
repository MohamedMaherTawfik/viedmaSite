<x-layout title="لوحه تحكم المعلم ">

    <!-- Sidebar -->
    <x-school-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-teacher-header />
            {{-- Success Message --}}
            @if (session('success'))
                <div class="p-4 mb-4 text-green-800 bg-green-200 border border-green-300 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Fail Message --}}
            @if (session('fail'))
                <div class="p-4 mb-4 text-red-800 bg-red-200 border border-red-300 rounded">
                    {{ session('fail') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="p-4 mb-4 text-red-800 bg-red-100 border border-red-300 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- شريط الترحيب -->
            <div class="bg-[#000E3FE0] rounded-lg shadow p-4 mb-6 flex items-center justify-between">
                <div class="text-[#ffffff] text-lg font-semibold">
                    👋 مرحباً بعودتك، أ. {{ Auth::user()->name }}
                </div>
                <img src="{{ asset('images/teacher.svg') }}" class="h-40 w-auto max-w-none" alt="ترحيب">
            </div>


            <!-- إحصائيات سريعة -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow p-4 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">عدد الدورات المسجل بها</p>
                        <p class="text-xl font-bold">{{ count($enrollments) }}</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l6.16-3.422A12.083 12.083 0 0112 21a12.083 12.083 0 01-6.16-10.422L12 14z" />
                    </svg>

                </div>

                <div class="bg-white rounded-lg shadow p-4 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">عدد المشاريع المرفوعة</p>
                        <p class="text-xl font-bold">{{ $assignments }}</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path d="M3 3h18v2H3V3zm0 4h18v2H3V7zm0 4h12v2H3v-2zm0 4h12v2H3v-2zm0 4h18v2H3v-2z" />
                    </svg>


                </div>

                <div class="bg-white rounded-lg shadow p-4 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">عدد الشهادات المستلمة</p>
                        <p class="text-xl font-bold">{{ count(Auth::user()->certificates) }}</p>
                    </div>
                    <i class="fas fa-certificate text-yellow-500 text-xl"></i>
                </div>
            </div>

            <!-- آخر الدورات -->
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <h2 class="text-lg font-semibold text-gray-700 flex items-center mb-4">
                    <i class="text-xl text-yellow-600 mr-2">🏅</i> آخر الدورات المسجل بها
                </h2>
                <div class="space-y-2">
                    @foreach ($enrollments as $enroll)
                        <div class="flex items-center justify-between bg-gray-50 p-3 rounded">
                            <span class="text-blue-600 font-medium">{{ $enroll->course->title }} </span>
                            <div class="text-sm text-gray-500 flex items-center gap-1">
                                Hours
                                {{ $enroll->course->duration }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


        </main>


    </div>

</x-layout>
