<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>تم إنشاء الحساب</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
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

    <div class="bg-white shadow-lg rounded-2xl p-6 max-w-xl w-full text-right relative">
        <button class="absolute top-2 left-2 text-gray-400 hover:text-gray-600 text-xl">&times;</button>

        <div class="flex items-center gap-4">
            <div class="bg-yellow-100 text-yellow-600 p-3 rounded-xl">
                👍
            </div>
            <div>
                <h2 class="text-xl font-bold mb-1">تم إنشاء الحساب بنجاح!</h2>
                <p class="text-sm text-gray-700 leading-relaxed">
                    حسابك الآن قيد المراجعة من قبل إدارة المنصة<br>
                    📢 سيتم إعلامك بالموافقة عبر البريد الإلكتروني أو داخل النظام.<br>
                    🔒 لا يمكنك تسجيل الدخول قبل تفعيل الحساب.<br>
                    🛠 في حال وجود استفسار يمكنك التواصل مع الإدارة مباشرة.
                </p>
            </div>
        </div>

        <div class="mt-4 text-left">
            <a href="{{ route('home') }}"
                class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition">
                الرئيسية
            </a>
        </div>
    </div>
</body>

</html>
