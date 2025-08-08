@php
    use App\Models\Enrollments;

    $enrolledCourseIds = Enrollments::where('user_id', auth()->id())
        ->pluck('courses_id')
        ->toArray();

@endphp

<x-layout title="لوحه تحكم المعلم ">

    <!-- Sidebar -->
    <x-school-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-teacher-header />
            {{-- Manage My Courses --}}
            <div class="text-left mt-4">
                <a href="{{ route('teacher.myCourses') }}"
                    class="border bg-gray-200 border-gray-400 text-gray-700 hover:border-gray-600 hover:text-gray-800 px-4 py-2 rounded-lg text-sm font-medium">
                    إدارة دوراتي
                </a>
            </div>

            <!-- Card Container -->
            @foreach ($courses as $course)
                <div class="bg-white w-2/3 rounded-lg shadow-md p-6 mt-6">

                    <!-- صف فيه يمين وشمال والخط الرأسي بينهم -->
                    <div class="flex items-start gap-6">

                        <!-- Right Section -->
                        <div class="w-2/3 text-right pr-6">

                            <!-- صورة و عنوان -->
                            <div class="flex items-center  mb-6">
                                <!-- الصورة على اليمين -->
                                <img src="{{ $course->image ? asset('storage/' . $course->image) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtEY1E5uyX1bU9au2oF74LoFPdthQlmZ5YIQ&s' }}"
                                    alt="Logo" class="w-24 h-24 ml-5 rounded-full border border-gray-300 shadow-md">


                                <!-- العنوان على الشمال -->
                                <div class="text-right">
                                    <h2 class="text-2xl font-bold text-gray-800">{{ $course->title }}
                                    </h2>
                                    <p class="text-gray-600 text-sm mt-1">{{ $course->description }} </p>
                                </div>
                            </div>

                            <!-- زر وتاريخ الانضمام -->
                            <div class="flex justify-between items-center mt-4">
                                <!-- الزر على اليمين -->

                                @if (in_array($course->id, $enrolledCourseIds))
                                    <a class="bg-gray-300 text-black font-bold py-2 px-4 rounded mr-2 cursor-default">
                                        مسجل
                                    </a>
                                @elseif ($course->price == 0)
                                    <a
                                        class="bg-[#176b98] hover:bg-[#176b98] text-white font-bold py-2 px-4 rounded mr-2">
                                        مجانية
                                    </a>
                                @else
                                    <a
                                        class="bg-[#3E8D19FF] hover:bg-[#327016FF] text-white font-bold py-2 px-4 rounded mr-2">
                                        {{ $course->price }} <span class="text-xs">&#xFDFC;</span>
                                    </a>
                                @endif


                                <!-- تاريخ الانضمام على الشمال -->
                                <div class="flex items-center">
                                    تاريخ
                                    النشر :
                                    <span class="text-gray-500 mr-2"> {{ $course->created_at->diffForHumans() }} </span>
                                </div>
                            </div>

                        </div>

                        <!-- الخط الرأسي -->
                        <div class="w-px bg-gray-300 self-stretch"></div>

                        <!-- Left Section -->
                        <div class="w-1/3 text-right">
                            <div class="flex items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-gray-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path
                                        d="M2 3a1 1 0 011-1h5.293L7.707 8.12a1 1 0 01-1.414 1.414L4.586 11H2a1 1 0 01-1-1V1a1 1 0 011-1h5.293L7.707 3.12a1 1 0 011.414-1.414L10.414 1H18a1 1 0 011 1v1a1 1 0 01-1 1h-5.293l1.707 1.707a1 1 0 01-1.414 1.414L10.414 6H2z" />
                                </svg>
                                <span class="text-gray-500">
                                    <span class="font-bold">الموعد:</span>
                                    {{ $course->duration }} ساعه
                                </span>
                            </div>

                            <div class="flex items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-gray-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path
                                        d="M2 3a1 1 0 011-1h5.293L7.707 8.12a1 1 0 01-1.414 1.414L4.586 11H2a1 1 0 01-1-1V1a1 1 0 011-1h5.293L7.707 3.12a1 1 0 011.414-1.414L10.414 1H18a1 1 0 011 1v1a1 1 0 01-1 1h-5.293l1.707 1.707a1 1 0 01-1.414 1.414L10.414 6H2z" />
                                </svg>
                                <span class="text-gray-500">
                                    <span class="font-bold">عدد المقاعد:</span>
                                    {{ count($course->enrollments) }}
                                </span>
                            </div>

                            <div class="flex items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-gray-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path
                                        d="M2 3a1 1 0 011-1h5.293L7.707 8.12a1 1 0 01-1.414 1.414L4.586 11H2a1 1 0 01-1-1V1a1 1 0 011-1h5.293L7.707 3.12a1 1 0 011.414-1.414L10.414 1H18a1 1 0 011 1v1a1 1 0 01-1 1h-5.293l1.707 1.707a1 1 0 01-1.414 1.414L10.414 6H2z" />
                                </svg>
                                <span class="text-gray-500">
                                    <span class="font-bold">المستوى:</span>
                                    {{ $course->level }}
                                </span>
                            </div>

                            <!-- زر عرض المزيد -->
                            <div class="text-left mt-10">

                                @if (in_array($course->id, $enrolledCourseIds))
                                    {{-- عرض المزيد لو المستخدم مسجل بالفعل --}}
                                    <a href="{{ route('teacher.myCourse', $course) }}"
                                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mr-2 inline-block">
                                        عرض المزيد
                                    </a>
                                @elseif ($course->price == 0)
                                    {{-- زر التسجيل المجاني --}}
                                    <form action="{{ route('teacher.course.enroll.free', $course->slug) }}"
                                        method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit"
                                            class="bg-[#176b98] hover:bg-[#176b98] text-white font-bold py-2 px-4 rounded mr-2">
                                            التسجيل
                                        </button>
                                    </form>
                                @else
                                    {{-- زر الاشتراك المدفوع --}}
                                    <form action="{{ route('pay.form', $course) }}" method="GET"
                                        class="inline-block">
                                        @csrf
                                        <button type="submit"
                                            class="bg-[#176b98] hover:bg-[#176b98] text-white font-bold py-2 px-4 rounded mr-2">
                                            الاشتراك
                                        </button>
                                    </form>
                                @endif


                            </div>

                        </div>

                    </div>

                </div>
            @endforeach
        </main>
    </div>

</x-layout>
