@php
    use App\Models\Courses;
    use Carbon\Carbon;
    $courses = Courses::where('user_id', $teacher->id)->pluck('title')->join(', ');
    $courseNumbers = Courses::where('user_id', $teacher->id)->count();
    $latestDate = $teacher->sessionTimes->sortByDesc('created_at')->first()?->date;
    $formattedDate = Carbon::parse($latestDate)->translatedFormat('j F');
@endphp
<x-layout title="لوحه تحكم المدرسه ">

    <!-- Sidebar -->
    <x-teacher-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-teacher-header />

            <section dir="rtl" class="p-6 bg-gray-50 min-h-screen font-[Cairo]">
                <div class="max-w-6xl mx-auto bg-white shadow rounded-xl p-6">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <img src="https://th.bing.com/th/id/R.4b6a7d8dc6ff6bd305a872c783d2f450?rik=IcLvZ3InG%2bn33g&pid=ImgRaw&r=0"
                                class="w-16 h-16 rounded-full border-2 border-white shadow" alt="Teacher Photo">
                            <h2 class="text-xl font-bold text-gray-800">تفاصيل المعلم</h2>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('sendNotification', [request('slug'), $teacher]) }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 text-center rounded-lg">إرسال
                                إشعار /
                                ملاحظة</a>
                        </div>
                    </div>

                    <!-- Teacher Info -->
                    <div class="grid grid-cols-2 gap-4 text-sm mb-8">
                        <div class="space-y-2">
                            <div>الاسم الكامل</div>
                            <input value="{{ $teacher->name }}"
                                class="w-full border rounded px-3 py-2 text-center bg-gray-100" disabled>
                        </div>
                        <div class="space-y-2">
                            <div>البريد الإلكتروني</div>
                            <input value="{{ $teacher->email }}"
                                class="w-full border rounded px-3 py-2 text-center bg-gray-100" disabled>
                        </div>
                        <div class="space-y-2">
                            <div>رقم الجوال</div>
                            <input value="{{ $teacher->applyTeacher->phone }}"
                                class="w-full border rounded px-3 py-2 text-center bg-gray-100" disabled>
                        </div>
                        <div class="space-y-2">
                            <div> المقرر الدراسي</div>
                            <input value="{{ $courses }}"
                                class="w-full border rounded px-3 py-2 text-center bg-gray-100" disabled>
                        </div>
                        <div class="space-y-2">
                            <div>الحاله</div>
                            <input value="{{ $teacher->applyTeacher->status }}"
                                class="w-full border border-green-500 text-green-600 font-semibold rounded px-3 py-2 text-center bg-green-50"
                                disabled>
                        </div>
                        <div class="space-y-2">
                            <div>تاريخ التسجيل</div>
                            <input value="{{ $teacher->created_at->format('d F Y') }}"
                                class="w-full border rounded px-3 py-2 text-center bg-gray-100" disabled>
                        </div>
                    </div>

                    @if ($teacher->applyTeacher->status === 'accepted')
                        <!-- Current Courses -->
                        <div class="mb-8">
                            <h3 class="text-lg font-bold mb-2">الدورات الحالية</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm border-separate border-spacing-y-2 text-right">
                                    <thead class="bg-gray-100 text-gray-700">
                                        <tr>
                                            <th class="px-4 py-2 text-center rounded-r-lg">الدورة</th>
                                            <th class="px-4 py-2 text-center rounded-r-lg">عدد الساعات</th>
                                            <th class="px-4 py-2 text-center rounded-r-lg">المرحله</th>
                                            <th class="px-4 py-2 text-center">تفاصيل الدورة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teacher->course as $item)
                                            <tr class="bg-white shadow rounded-lg">
                                                <td class="px-4 py-2 text-center">{{ $item->title }} </td>
                                                <td class="px-4 py-2 text-center text-red-600">{{ $item->duration }}
                                                </td>
                                                <td class="px-4 py-2 text-center text-green-600">{{ $item->level }}
                                                </td>
                                                <td class="px-4 py-2 text-center text-blue-500"><a
                                                        href="#">عرض</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Uploaded Projects -->
                        <div class="mb-8">
                            <h3 class="text-lg font-bold mb-2">المشاريع المرفوعة</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm border-separate border-spacing-y-2 text-right">
                                    <thead class="bg-gray-100 text-gray-700">
                                        <tr>
                                            <th class="px-4 py-2 text-center rounded-r-lg">الاسم</th>
                                            <th class="px-4 py-2 text-center">الحالة</th>
                                            <th class="px-4 py-2 text-center">المحتوى</th>
                                            {{-- <th class="px-4 py-2 text-center">الدورة</th> --}}
                                            <th class="px-4 py-2 text-center">تفاصيل المشروع</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teacher->graduationProjects as $item)
                                            <tr class="bg-white shadow rounded-lg">
                                                <td class="px-4 py-2 text-center"> {{ $item->title }}</td>
                                                <td class="px-4 py-2 text-center text-orange-500">{{ $item->status }}
                                                </td>
                                                <td class="px-4 py-2 text-center">{{ $item->file }}</td>
                                                {{-- <td class="px-4 py-2 text-center">{{$item->}}</td> --}}
                                                <td class="px-4 py-2 text-center text-blue-500"><a
                                                        href="#">عرض</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Teacher Ratings -->
                        <div class="mb-8">
                            <h3 class="text-lg font-bold mb-2">تقييمات المعلم</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm border-separate border-spacing-y-2 text-right">
                                    <thead class="bg-gray-100 text-gray-700">
                                        <tr>
                                            <th class="px-4 py-2 text-center rounded-r-lg">اسم المقيم</th>
                                            <th class="px-4 py-2 text-center">التاريخ</th>
                                            <th class="px-4 py-2 text-center">التقييم</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reports as $item)
                                            <tr class="bg-white shadow rounded-lg">
                                                <td class="px-4 py-2 text-center">{{ $item->student->name }}</td>
                                                <td class="px-4 py-2 text-center">{{ $item->user->created_at }}</td>
                                                <td class="px-4 py-2 text-center text-green-600">{{ $item->report }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- General Status -->
                        <div class="bg-gray-100 border border-dashed rounded-lg p-4 text-sm">
                            <p class="mb-2">✅ الدورات الخاصه بالمدرب وهم {{ $courseNumbers }} دوره</p>
                            <p class="mb-2">📚 عدد الشهادات المكتسبة: <span class="font-semibold">1</span></p>
                            <p class="mb-2">📅 آخر دخول للنظام في <span class="font-semibold text-blue-600">

                                    {{ $teacher->sessionTimes->sortByDesc('created_at')->first()?->time }} -
                                    {{ $formattedDate }}
                                </span></p>
                            @php
                                $latestProject = $teacher->graduationProjects->sortByDesc('created_at')->first();
                            @endphp

                            @if ($latestProject)
                                <p>❗آخر مشروع مرفوع بتاريخ
                                    {{ \Carbon\Carbon::parse($latestProject->created_at)->translatedFormat('j F Y') }}
                                </p>
                            @else
                                <p class="text-red-500">لم يتم رفع مشاريع بعد</p>
                            @endif

                        </div>
                    @else
                    @endif

                </div>
            </section>

        </main>

    </div>

    <script>
        //
    </script>
</x-layout>
