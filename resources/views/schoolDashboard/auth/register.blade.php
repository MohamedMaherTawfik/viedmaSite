<!DOCTYPE html>
<html lang="ar" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>تسجيل مدرسة جديدة</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 w-screen min-h-screen md:h-screen overflow-auto m-0">
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
    <div class="w-full h-full grid grid-cols-1 md:grid-cols-2">
        {{-- Success Message --}}


        <!-- Illustration (مخفية على الجوال، تظهر من lg فما فوق) -->
        <div class="hidden md:flex bg-[#f8f6f4] items-center justify-center p-8">
            <img src="{{ asset('auth/WhatsApp Image 2025-07-05 at 17.28.44_7ec5a7e4.jpg') }}" alt="illustration"
                class="w-full max-w-sm object-contain">
        </div>

        <!-- Form Section -->
        <div class="p-6 md:p-8 flex flex-col justify-center">
            <div class="flex items-center gap-2 self-center">
                <img src="{{ asset('auth/rendered_page.png') }}" alt="robot" class="w-72 h-48">
            </div>
            <h2 class="text-2xl font-bold mb-1 self-center">تسجيل دخول</h2>

            <form method="POST" action="{{ route('school.register.store') }}" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- اسم المدرسة -->
                    <div>
                        <label class="block text-sm font-medium">اسم المدرسة</label>
                        <input type="text" name="school_name" placeholder="مدرسة النور الخاصة"
                            class="w-full border px-3 py-3 rounded focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('school_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- نوع المدرسة -->
                    <div>
                        <label class="block text-sm font-medium">نوع المدرسة</label>
                        <select name="type"
                            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="أهلية">أهلي</option>
                            <option value="حكومية">حكومي</option>
                            <option value="لغات">لغات</option>
                        </select>
                        @error('type')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- المحافظة / المدينة -->
                    <div>
                        <label class="block text-sm font-medium">المحافظة / المدينة</label>
                        <input type="text" name="city" placeholder="اسم المدينة"
                            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('city')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- رقم الترخيص -->
                    <div>
                        <label class="block text-sm font-medium">رقم الترخيص</label>
                        <input type="text" name="License_number" placeholder="رقم الترخيص"
                            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('License_number')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- العنوان التفصيلي -->
                    <div>
                        <label class="block text-sm font-medium">العنوان التفصيلي</label>
                        <input type="text" name="address" placeholder="العنوان الكامل للمدرسة"
                            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('address')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- البريد الإلكتروني -->
                    <div>
                        <label class="block text-sm font-medium">البريد الإلكتروني الرسمي</label>
                        <input type="email" name="email" placeholder="example@email.com"
                            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- رقم موبايل المسؤول -->
                    <div>
                        <label class="block text-sm font-medium">رقم موبايل المسؤول</label>
                        <input type="text" name="phone" placeholder="رقم الموبايل"
                            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('phone')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- اسم مسؤول الحساب -->
                    <div>
                        <label class="block text-sm font-medium">اسم مسؤول الحساب</label>
                        <input type="text" name="name" placeholder="مثال: سراج محمد"
                            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- كلمة المرور -->
                    <div>
                        <label class="block text-sm font-medium">كلمة المرور</label>
                        <input type="password" name="password" placeholder="********"
                            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- تكرار كلمة المرور -->
                    <div>
                        <label class="block text-sm font-medium">تكرار كلمة المرور</label>
                        <input type="password" name="password_confirmation" placeholder="********"
                            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>

                <!-- الشروط -->
                <div class="flex items-center gap-2 text-sm mt-4">
                    <input type="checkbox" required
                        class="w-4 h-4 border-gray-300 text-blue-600 rounded focus:ring-blue-500">
                    <label class="text-gray-600">أوافق على الشروط والأحكام</label>
                </div>

                <!-- زر الإرسال -->
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded hover:bg-blue-700 transition duration-200 mt-2">
                    إرسال بيانات التسجيل
                </button>

                <!-- رابط تسجيل الدخول -->
                <p class="text-sm text-center mt-6">
                    ليس لديك حساب؟
                    <a href="{{ route('school.login') }}" class="text-blue-600 hover:underline font-medium">
                        تسجيل دخول
                    </a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>
