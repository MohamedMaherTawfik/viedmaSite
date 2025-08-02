<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-200 min-h-screen">
    <div class="bg-white w-screen h-screen grid grid-cols-1 md:grid-cols-2">

        <!-- Left Illustration -->
        <div class="bg-[#f8f6f4] flex items-center justify-center p-10">
            <img src="{{ asset('auth/WhatsApp Image 2025-07-05 at 17.28.44_7ec5a7e4.jpg') }}" alt="login illustration"
                class="w-full max-w-md">
        </div>

        <!-- Right Form -->
        <div class="p-10 flex flex-col justify-center">
            <div class="flex items-center gap-2 mb-4 self-center">
                <img src="{{ asset('auth/rendered_page.png') }}" alt="robot" class="w-72 h-48">
            </div>
            <h2 class="text-2xl font-bold mb-1 self-center">تسجيل دخول</h2>
            <p class="text-sm text-gray-500 mb-6 self-center">
                الرجاء تسجيل الدخول لمتابعة إلى حسابك.
            </p>


            <form method="POST" action="{{ route('signin') }}" class="w-full text-right">
                @csrf

                <!-- البريد الإلكتروني -->
                <label class="text-sm font-medium mb-1 text-right w-full block">البريد الإلكتروني</label>
                <input type="email" placeholder="example@email.com" name="email"
                    class="mb-4 border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500">

                <!-- كلمة المرور -->
                <label class="text-sm font-medium mb-1 text-right w-full block">كلمة المرور</label>
                <div class="relative mb-2">
                    <input type="password" placeholder="********" name="password"
                        class="border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10">
                    <span class="absolute inset-y-0 right-3 flex items-center text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </span>
                </div>

                <!-- تذكرني ونسيت كلمة المرور -->
                <div class="flex items-center justify-between mb-4 text-sm">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" class="form-checkbox rounded border-gray-300 text-blue-600">
                        حفظ الحساب على هذا الجهاز
                    </label>
                    <a href="#" class="text-red-500 hover:underline">نسيت كلمة المرور؟</a>
                </div>

                <!-- زر الدخول -->
                <button type="submit"
                    class="bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200 w-full mb-4">
                    تسجيل الدخول
                </button>
            </form>

            {{--
            <div class="flex items-center gap-2 text-sm mb-4">
                <div class="flex-grow h-px bg-gray-300"></div>
                أو
                <div class="flex-grow h-px bg-gray-300"></div>
            </div> --}}

            {{-- <button
                class="border border-gray-300 flex items-center justify-center gap-2 py-2 rounded w-full mb-3 hover:bg-gray-50">
                <img src="https://img.icons8.com/color/48/google-logo.png" class="w-5 h-5" />
                تسجيل الدخول باستخدام Google
            </button> --}}

            <p class="text-center text-sm mt-6">
                ليس لديك حساب؟ <a href="{{ route('register') }}" class="text-blue-600 hover:underline">حساب جديد</a>
            </p>
        </div>
    </div>
</body>


</html>
