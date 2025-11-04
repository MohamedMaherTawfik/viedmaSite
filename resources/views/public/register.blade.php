<!DOCTYPE html>
<html lang="ar" dir="rtl">

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

    <div class="bg-white w-screen h-screen grid grid-cols-1 md:grid-cols-2">

        <!-- Right Form (now first column in RTL) -->
        <div class="p-10 flex flex-col justify-center items-start text-right">
            <div class="flex items-center mb-4 self-center">
                <x-logo-component></x-logo-component>
            </div>
            <h2 class="text-2xl font-bold mb-1 self-start">انشاء حساب</h2>
            <p class="text-sm text-gray-500 mb-6 self-start">
                الرجاء تسجيل الدخول لمتابعة إلى حسابك.
            </p>


            <form method="POST" action="{{ route('register.store') }}" class="w-full text-right">
                @csrf

                <!-- الاسم الكامل -->
                <label class="text-xs font-medium mb-1 w-full self-start">الاسم الكامل</label>
                <input type="text" name="name" placeholder="الاسم الكامل"
                    class="mb-4 border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                @error('name')
                    <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                @enderror

                <!-- الرقم القومي -->
                <label class="text-xs font-medium mb-1 w-full self-start">الرقم القومي</label>
                <input type="text" name="national_id" placeholder="الرقم القومي"
                    class="mb-4 border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                @error('national_id')
                    <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                @enderror

                <!-- الجنسية -->
                <label class="text-xs font-medium mb-1 w-full self-start">الجنسية</label>
                <input type="text" name="nationallity" placeholder="الجنسية"
                    class="mb-4 border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                @error('nationallity')
                    <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                @enderror

                <!-- المرحلة الدراسية -->
                <label class="text-xs font-medium mb-1 w-full self-start">المرحلة الدراسية</label>
                <input type="text" name="academic_stage" placeholder="المرحلة الدراسية"
                    class="mb-4 border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                @error('academic_stage')
                    <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                @enderror

                <!-- المدرسة -->
                <label class="text-xs font-medium mb-1 w-full self-start">المدرسة</label>
                <select name="school_id"
                    class="mb-4 border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    <option value="">اختر المدرسة</option>
                    @foreach ($schools as $school)
                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>
                @error('school_id')
                    <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                @enderror

                <!-- البريد الإلكتروني -->
                <label class="text-xs font-medium mb-1 w-full self-start">البريد الإلكتروني</label>
                <input type="email" name="email" placeholder="example@email.com"
                    class="mb-4 border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                @error('email')
                    <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                @enderror

                <!-- كلمة المرور -->
                <label class="text-xs font-medium mb-1 w-full self-start">كلمة المرور</label>
                <input type="password" name="password" placeholder="********"
                    class="mb-4 border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                @error('password')
                    <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                @enderror

                <!-- تأكيد كلمة المرور -->
                <label class="text-xs font-medium mb-1 w-full self-start">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" placeholder="********"
                    class="mb-6 border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">

                <button type="submit"
                    class="bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200 w-full">
                    ارسال بيانات التسجيل
                </button>
            </form>



            {{-- <div class="flex items-center gap-2 text-sm mb-4 w-full">
                <div class="flex-grow h-px bg-gray-300"></div>
                أو
                <div class="flex-grow h-px bg-gray-300"></div>
            </div>

            <button
                class="border border-gray-300 flex items-center justify-center gap-2 py-2 rounded w-full mb-3 hover:bg-gray-50">
                <img src="https://img.icons8.com/color/48/google-logo.png" class="w-5 h-5" />
                تسجيل الدخول باستخدام Google
            </button> --}}

            <p class="text-sm mt-6 text-center w-full">
                لديك حساب؟ <a href="{{ route('login') }}" class="text-blue-600 hover:underline">تسجيل دخول</a>
            </p>

        </div>

        <!-- Left Illustration (now second column in RTL) -->
        <div class="bg-[#f8f6f4] flex items-center justify-center p-10">
            <img src="{{ asset('images/Ai-removebg-preview.png') }}" alt="login illustration" class="w-full max-w-md">
        </div>
    </div>
</body>

</html>
