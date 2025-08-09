<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إشعار قبول الطلب</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    <div class="max-w-lg mx-auto mt-10 bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">

        <!-- Header -->
        <div class="bg-indigo-600 text-white text-center py-4">
            <h1 class="text-2xl font-bold">VIEDMA</h1>
        </div>

        <!-- Content -->
        <div class="p-6 text-gray-800">
            <h2 class="text-xl font-semibold mb-4">مرحباً،</h2>
            <p class="leading-relaxed mb-6">
                تم قبول طلبك للانضمام إلى <span class="font-bold">VIEDMA</span>، يمكنك تسجيل الدخول بحسابك الآن.
            </p>
            <div class="text-center">
                <a href="{{ url('/login') }}"
                    class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg shadow hover:bg-indigo-700 transition">
                    تسجيل الدخول الآن
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-50 text-center py-3 text-sm text-gray-500 border-t border-gray-200">
            &copy; {{ date('Y') }} VIEDMA. جميع الحقوق محفوظة.
        </div>
    </div>

</body>

</html>
