<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>اختيار نوع المستخدم</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#f8f6f4] min-h-screen font-[Cairo]">

    <div class="max-w-6xl mx-auto px-4 pt-16">
        <!-- ✅ صورة مكبرة -->
        <img src="{{ asset('auth/rendered_page.png') }}" alt="VIEDMA LOGO" class="mx-auto mb-6 w-72 h-36">

        <h1 class="text-3xl font-bold text-center text-[#176b98] mb-10">اختر نوع المستخدم</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <!-- ولي أمر -->
            <a href="{{ route('parent.login') }}"
                class="block bg-white rounded-2xl shadow-md hover:shadow-xl hover:ring-2 hover:ring-[#176b98] transition duration-300 p-8 text-center">
                <img src="https://img.icons8.com/ios-filled/100/F04A22/family--v1.png" alt="ولي أمر"
                    class="mx-auto mb-4 w-20 h-20">
                <h2 class="text-xl font-bold text-[#374151]">ولي أمر</h2>
            </a>

            <!-- مدرب -->
            <a href="#"
                class="block bg-white rounded-2xl shadow-md hover:shadow-xl hover:ring-2 hover:ring-[#176b98] transition duration-300 p-8 text-center">
                <img src="https://img.icons8.com/ios-filled/100/75C151/coach.png" alt="مدرب"
                    class="mx-auto mb-4 w-20 h-20">
                <h2 class="text-xl font-bold text-[#374151]">مدرب</h2>
            </a>

            <!-- معلم -->
            <a href="{{ route('login') }}"
                class="block bg-white rounded-2xl shadow-md hover:shadow-xl hover:ring-2 hover:ring-[#176b98] transition duration-300 p-8 text-center">
                <img src="https://img.icons8.com/ios-filled/100/FEBE35/teacher.png" alt="معلم"
                    class="mx-auto mb-4 w-20 h-20">
                <h2 class="text-xl font-bold text-[#374151]">معلم</h2>
            </a>
        </div>
    </div>

</body>

</html>
