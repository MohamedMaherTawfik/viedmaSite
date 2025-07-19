<x-layout>

    <!-- Sidebar -->
    <x-school-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-teacher-header />

            <!-- Main Content Section -->
            <div class="flex flex-row-reverse gap-4">

                <!-- Column 1: Files Section (on the right) -->
                <div class="w-1/3 bg-white rounded-lg shadow-md p-4">
                    <h2 class="text-xl font-bold mb-4">ملفات الدورة</h2>
                    <div class="mb-2">
                        <a href="#" class="text-blue-500 hover:underline">https://sharefile.xyz/file.jpg </a>
                        <button class="bg-gray-200 text-gray-700 px-2 py-1 rounded ml-2">تنزيل</button>
                    </div>
                    <div class="mt-4">
                        <img src="https://via.placeholder.com/150 " alt="File Preview"
                            class="w-16 h-16 object-cover rounded">
                        <button class="bg-gray-200 text-gray-700 px-2 py-1 rounded ml-2">تنزيل</button>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold">مشروع التخرج</h3>
                        <p class="text-gray-600">تصميم شاشة عرض</p>
                        <button class="bg-green-500 text-white px-4 py-2 mt-2 rounded hover:bg-green-600">رفع
                            المشروع</button>
                        <p class="text-sm text-gray-500 mt-2">
                            اسحب ملفك أو انضم (ملفات فقط)<br>
                            الحد الأقصى المسموح به هو 10 ميجابايت<br>
                            للملفات
                        </p>
                    </div>
                    <button class="bg-green-500 text-white px-4 py-2 mt-4 rounded hover:bg-green-600">تحميل
                        المعلومات</button>
                </div>

                <!-- Column 2: Schedule Section (center) -->
                <div class="w-2/3 bg-white rounded-lg shadow-md p-4">
                    <h2 class="text-xl font-bold mb-4">جدول الدروس</h2>
                    <div class="flex justify-between items-center mb-4">
                        <span>Mon</span>
                        <span>Tues</span>
                        <span>Wed</span>
                        <span>Thu</span>
                        <span>Fri</span>
                        <span>Sat</span>
                    </div>
                    <div class="grid grid-cols-6 gap-4">
                        <!-- Monday -->
                        <div class="col-span-1">
                            <div class="bg-gray-200 p-2 rounded">
                                <p class="text-gray-600">02</p>
                            </div>
                        </div>
                        <!-- Tuesday -->
                        <div class="col-span-1">
                            <div class="bg-gray-200 p-2 rounded">
                                <p class="text-gray-600">03</p>
                            </div>
                        </div>
                        <!-- Wednesday -->
                        <div class="col-span-1">
                            <div class="bg-gray-200 p-2 rounded">
                                <p class="text-gray-600">04</p>
                            </div>
                        </div>
                        <!-- Thursday -->
                        <div class="col-span-1">
                            <div class="bg-gray-200 p-2 rounded">
                                <p class="text-gray-600">05</p>
                            </div>
                        </div>
                        <!-- Friday -->
                        <div class="col-span-1">
                            <div class="bg-gray-200 p-2 rounded">
                                <p class="text-gray-600">06</p>
                            </div>
                        </div>
                        <!-- Saturday -->
                        <div class="col-span-1">
                            <div class="bg-gray-200 p-2 rounded">
                                <p class="text-gray-600">07</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <!-- Meeting Card -->
                        <div class="bg-blue-500 text-white p-4 rounded mb-4">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <img src="https://via.placeholder.com/30 " alt="Avatar"
                                        class="w-8 h-8 rounded-full mr-2">
                                    <img src="https://via.placeholder.com/30 " alt="Avatar"
                                        class="w-8 h-8 rounded-full mr-2">
                                    <img src="https://via.placeholder.com/30 " alt="Avatar"
                                        class="w-8 h-8 rounded-full mr-2">
                                    <img src="https://via.placeholder.com/30 " alt="Avatar"
                                        class="w-8 h-8 rounded-full">
                                </div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path
                                            d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11 11-4.925 11-11S18.075 1 12 1zm0 19c-4.97 0-9-3.93-9-9s3.93-9 9-9 9 3.93 9 9-3.93 9-9 9z" />
                                    </svg>
                                    <span class="ml-2">Zoom</span>
                                </div>
                            </div>
                            <p class="mt-2">الوحدة 1: مقدمة</p>
                            <p class="text-sm">الأثنين - الخميس</p>
                            <p class="text-sm">10:44 am</p>
                        </div>
                        <!-- Lecture Card -->
                        <div class="bg-red-500 text-white p-4 rounded mb-4">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <img src="https://via.placeholder.com/30 " alt="Avatar"
                                        class="w-8 h-8 rounded-full mr-2">
                                    <img src="https://via.placeholder.com/30 " alt="Avatar"
                                        class="w-8 h-8 rounded-full mr-2">
                                    <img src="https://via.placeholder.com/30 " alt="Avatar"
                                        class="w-8 h-8 rounded-full mr-2">
                                    <img src="https://via.placeholder.com/30 " alt="Avatar"
                                        class="w-8 h-8 rounded-full">
                                </div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path
                                            d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11 11-4.925 11-11S18.075 1 12 1zm0 19c-4.97 0-9-3.93-9-9s3.93-9 9-9 9 3.93 9 9-3.93 9-9 9z" />
                                    </svg>
                                    <span class="ml-2">Zoom</span>
                                </div>
                            </div>
                            <p class="mt-2">الوحدة 1: مقدمة</p>
                            <p class="text-sm">الأثنين - الخميس</p>
                            <p class="text-sm">10:44 am</p>
                        </div>
                    </div>
                </div>

                <!-- Column 3: Placeholder (on the left) -->
                <div class="w-1/3 bg-white rounded-lg shadow-md p-4 hidden md:block">
                    <!-- This column can be used for additional information or ads -->
                </div>
            </div>
        </main>
    </div>
</x-layout>
