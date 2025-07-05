<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم المعلم</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100 font-sans" x-data="{ sidebarOpen: false }">
    <!-- Header -->
    <header class="bg-white shadow p-4 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <h1 class="text-lg font-bold text-gray-800">لوحة التحكم المعلم</h1>
        </div>
        <div class="text-sm text-gray-500">ابحث داخل لوحة التحكم</div>
    </header>

    <!-- Sidebar -->
    <aside x-show="sidebarOpen" @click.away="sidebarOpen = false"
        class="fixed right-0 top-0 h-full bg-white shadow-lg w-64 z-30 p-5 space-y-4 transition duration-300"
        x-transition>
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-lg">محمد احمد</h2>
                <p class="text-sm text-gray-500">معلم</p>
            </div>
        </div>
        <nav class="space-y-2">
            <a href="#" class="block py-2 px-4 rounded hover:bg-blue-100 text-blue-700 font-bold">الرئيسية</a>
            <a href="#" class="block py-2 px-4 rounded hover:bg-gray-100">الدورات</a>
            <a href="#" class="block py-2 px-4 rounded hover:bg-gray-100">الاشعارات</a>
            <a href="#" class="block py-2 px-4 rounded hover:bg-gray-100">المشاريع</a>
            <a href="#" class="block py-2 px-4 rounded hover:bg-gray-100">ادارة الطلاب</a>
        </nav>
    </aside>

    <!-- Main -->
    <main class="p-6 mt-6">
        <div class="bg-blue-700 text-white rounded-lg p-6 text-lg mb-6">
            مرحباً بعودتك، أ. محمد احمد 👋
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white shadow rounded-lg p-4 text-center">
                <div class="text-3xl font-bold">2</div>
                <div class="text-sm text-gray-600">عدد الشهادات المستلمة</div>
            </div>
            <div class="bg-white shadow rounded-lg p-4 text-center">
                <div class="text-3xl font-bold">2</div>
                <div class="text-sm text-gray-600">عدد المشاريع المرفوعة</div>
            </div>
            <div class="bg-white shadow rounded-lg p-4 text-center">
                <div class="text-3xl font-bold">5</div>
                <div class="text-sm text-gray-600">عدد الدورات المسجل بها</div>
            </div>
        </div>

        <!-- Courses and Notifications -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Latest Courses -->
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="font-bold text-lg mb-2">آخر الدورات المسجل بها</h3>
                <ul class="space-y-2">
                    <li class="flex justify-between items-center bg-gray-50 p-2 rounded">
                        <span>منصة إلى STEM</span>
                        <span class="text-blue-500">🏆</span>
                    </li>
                    <li class="flex justify-between items-center bg-gray-50 p-2 rounded">
                        <span>منصة إلى STEM</span>
                        <span class="text-blue-500">🏆</span>
                    </li>
                </ul>
            </div>

            <!-- Latest Notifications -->
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="font-bold text-lg mb-2">أحدث التنبيهات</h3>
                <ul class="space-y-2">
                    <li class="flex items-center justify-between bg-yellow-50 p-2 rounded">
                        <span>تم تقييم المشروع بنجاح</span>
                        <span>⭐</span>
                    </li>
                    <li class="flex items-center justify-between bg-yellow-50 p-2 rounded">
                        <span>تم تقييم المشروع بنجاح</span>
                        <span>⭐</span>
                    </li>
                </ul>
            </div>
        </div>
    </main>
</body>

</html>
