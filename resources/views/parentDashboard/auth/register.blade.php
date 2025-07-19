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
    <div class="bg-white w-screen h-screen grid grid-cols-1 md:grid-cols-2">

        <!-- Right Form (now first column in RTL) -->
        <div class="p-5 flex flex-col justify-center items-start text-right">
            <div class="flex items-center gap-2 mb-4 self-start">
                <img src="{{ asset('auth/rendered_page.png') }}" alt="robot" class="w-96 h-48">
            </div>
            <h2 class="text-2xl font-bold mb-1 self-start">انشاء حساب</h2>
            <p class="text-sm text-gray-500 mb-6 self-start">
                الرجاء تسجيل الدخول لمتابعة إلى حسابك.
            </p>

            @php
                use App\Models\school;
                $schools = school::get();
            @endphp

            <form method="POST" action="{{ route('parent.register.store') }}" class="w-full text-right">
                @csrf

                <!-- الاسم بالكامل والمدرسة -->
                <div class="mb-4 md:flex md:gap-4">
                    <!-- الاسم بالكامل -->
                    <div class="md:w-1/2 w-full">
                        <label class="text-xs font-medium mb-1 block">الاسم بالكامل</label>
                        <input type="text" placeholder="username" name="name"
                            class="border px-4 py-3 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- المدرسة -->
                    <div class="md:w-1/2 w-full">
                        <label class="text-xs font-medium mb-1 block">المدرسة</label>
                        <select name="school_id"
                            class="border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            <option value="">اختر المدرسة</option>
                            @foreach ($schools as $school)
                                <option value="{{ $school->id }}"
                                    {{ old('school_id') == $school->id ? 'selected' : '' }}>
                                    {{ $school->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('school_id')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- البريد الإلكتروني -->
                <label class="text-xs font-medium mb-1 w-full self-start">البريد الإلكتروني</label>
                <input type="email" placeholder="example@email.com" name="email"
                    class="mb-4 border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    value="{{ old('email') }}">
                @error('email')
                    <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                @enderror

                <!-- رقم الهاتف -->
                <label class="text-xs font-medium mb-1 w-full self-start">رقم الهاتف</label>
                <input type="text" placeholder="01012345678" name="phone"
                    class="mb-4 border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    value="{{ old('phone') }}">
                @error('phone')
                    <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                @enderror

                <!-- كلمة المرور -->
                <label class="text-xs font-medium mb-1 w-full self-start">كلمة المرور</label>
                <div class="relative mb-2 w-full">
                    <input type="password" placeholder="********" name="password"
                        class="border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm ">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                        <!-- Icon -->
                    </span>
                </div>
                @error('password')
                    <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                @enderror

                <!-- تكرار كلمة المرور -->
                <label class="text-xs font-medium mb-1 w-full self-start">تكرار كلمة المرور</label>
                <div class="relative mb-4 w-full">
                    <input type="password" placeholder="********" name="password_confirmation"
                        class="border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm ">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                        <!-- Icon -->
                    </span>
                </div>

                <button type="submit"
                    class="bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200 w-full mb-4">
                    ارسال بيانات التسجيل
                </button>
            </form>




            <div class="flex items-center gap-2 text-sm mb-4 w-full">
                <div class="flex-grow h-px bg-gray-300"></div>
                أو
                <div class="flex-grow h-px bg-gray-300"></div>
            </div>

            <button
                class="border border-gray-300 flex items-center justify-center gap-2 py-2 rounded w-full mb-3 hover:bg-gray-50">
                <img src="https://img.icons8.com/color/48/google-logo.png" class="w-5 h-5" />
                تسجيل الدخول باستخدام Google
            </button>

            <p class="text-sm mt-6 text-center w-full">
                لديك حساب؟ <a href="{{ route('parent.login') }}" class="text-blue-600 hover:underline">تسجيل دخول</a>
            </p>

        </div>

        <!-- Left Illustration (now second column in RTL) -->
        <div class="bg-[#f8f6f4] flex items-center justify-center p-10">
            <img src="{{ asset('auth/WhatsApp Image 2025-07-05 at 17.28.44_7ec5a7e4.jpg') }}" alt="login illustration"
                class="w-full max-w-md">
        </div>
    </div>
</body>

</html>
