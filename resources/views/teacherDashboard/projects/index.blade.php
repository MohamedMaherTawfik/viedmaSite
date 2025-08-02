<x-layout>

    <!-- Sidebar -->
    <x-school-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-teacher-header />

            <!-- محتوى الصفحة الرئيسية -->
            <div class="flex flex-col md:flex-row gap-4">

                <!-- جزء المشاريع (نقله لليمين) -->
                <div class="bg-white shadow rounded-lg p-4 w-full md:w-2/3">
                    <h2 class="text-xl font-bold mb-4">مشاريع تم الرد عليها</h2>

                    <!-- رأس الجدول -->
                    <div class="grid grid-cols-4 gap-4 font-semibold text-gray-700 border-b pb-2 mb-4">
                        <div class="text-center">

                            التاريخ
                        </div>
                        <div class="text-center">الدرجه</div>
                        <div class="text-center">اسم المشروع</div>
                    </div>

                    <!-- كل مشروع -->
                    @foreach ($assignments as $item)
                        <div class="grid grid-cols-4 gap-4 text-center items-center py-3 border-b text-sm">
                            <div class="text-gray-600">
                                {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                            </div>



                            <div>
                                <span
                                    class="px-2 text-center py-1 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                    @if ($item->grade == '')
                                        'لم يتم التقييم بعد'
                                    @else
                                        "{{ $item->grade }}"
                                    @endif
                                </span>
                            </div>
                            <div class="text-gray-700 text-center"> {{ $item->graduationProject->title }} </div>
                        </div>

                        <!-- رسالة فارغة -->
                        <div class="flex justify-center items-center mt-6 text-center text-sm text-red-500 gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7.5 12h9m-9 3h6m3 6v-3.6A2.4 2.4 0 0018 15.6V6a2.4 2.4 0 00-2.4-2.4H6A2.4 2.4 0 003.6 6v9a2.4 2.4 0 002.4 2.4h3.6L15 21z" />
                            </svg>
                            <div class="text-gray-500">
                                @if ($item->graduationNotes->isEmpty())
                                    لم توجد ملاحظات بعد
                                @else
                                    "{{ $item->graduationNotes->first()->note }}"
                                @endif
                            </div>
                        </div>
                    @endforeach

                </div>


                <!-- جزء رفع المشروعات (نقله لليسار) -->
                <div class="bg-white shadow rounded-lg p-4 w-full md:w-1/3">
                    <h2 class="text-xl font-bold mb-4">رفع مشروع جديد</h2>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="fileUpload"
                            class="cursor-pointer border-dashed border-2 border-gray-300 rounded-lg p-8 text-center block hover:bg-gray-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mx-auto mb-2 text-blue-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-gray-500"> اضف ملفك أو ملفاتك ( يفضل ملف مضغوط )</p>
                            <p class="text-sm text-gray-400">الحد الأقصى المسموح به هو 10 ميجابايت للملفات</p>
                            <input type="file" name="file" id="fileUpload" class="hidden" multiple>
                        </label>

                        <div class="text-center mt-4">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg shadow">
                                رفع الملفات
                            </button>
                        </div>
                    </form>

                    <div class="mt-4">
                        <!-- قائمة الملفات المرفوعة -->

                        <div class="bg-gray-100 rounded-lg p-2 mt-2">
                            @foreach ($assignments as $item)
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtEY1E5uyX1bU9au2oF74LoFPdthQlmZ5YIQ&s"
                                            alt="File thumbnail" class="ml-2 w-10 h-10 rounded mr-2">
                                        <div>
                                            <p class="text-gray-700">{{ $item->file }}</p>
                                            <p class="text-red-500 text-xs">Uploaded Successfully</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="text-gray-500 hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- <button class="bg-green-500 text-white px-4 py-2 mt-4 rounded hover:bg-green-600">
                            إعادة رفع المشروع
                        </button> --}}
                    </div>
                </div>

            </div>
        </main>
    </div>

</x-layout>
