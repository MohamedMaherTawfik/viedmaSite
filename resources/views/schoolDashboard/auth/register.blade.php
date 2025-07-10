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

<body class="bg-gray-100 w-screen h-screen overflow-hidden m-0">
    <div class="w-full h-full grid grid-cols-1 md:grid-cols-2">

        <!-- Illustration -->
        <div class="bg-[#f8f6f4] flex items-center justify-center p-8">
            <img src="{{ asset('auth/WhatsApp Image 2025-07-05 at 17.28.44_7ec5a7e4.jpg') }}" alt="illustration"
                class="w-full max-w-sm">
        </div>

        <!-- Form -->
        <div class=" p-3 text-right overflow-y-auto">
            <div class="flex items-center">
                <img src="{{ asset('auth/rendered_page.png') }}" class="w-30 h-30" alt="logo">
                <h1 class="text-2xl font-bold ml-2">حساب جديد</h1>
            </div>

            <form method="POST" action="{{ route('school.register.store') }}" class="space-y-4">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <!-- كل الحقول زي ما هي -->
                    <div>
                        <label class="block text-sm font-medium">اسم المدرسة</label>
                        <input type="text" name="school_name" placeholder="مدرسة النور الخاصة"
                            class="w-full border px-3 py-3 rounded focus:ring-2 focus:ring-blue-500">
                        @error('school_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">نوع المدرسة</label>
                        <select name="type" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-500">
                            <option value="أهلية">أهلي</option>
                            <option value="حكومية">حكومي</option>
                            <option value="لغات">لغات</option>
                        </select>
                        @error('type')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">المحافظة / المدينة</label>
                        <input type="text" name="city" placeholder="اسم المدينة"
                            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-500">
                        @error('city')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">رقم الترخيص</label>
                        <input type="text" name="License_number" placeholder="رقم الترخيص"
                            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-500">
                        @error('License_number')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">العنوان التفصيلي</label>
                        <input type="text" name="address" placeholder="العنوان الكامل للمدرسة"
                            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-500">
                        @error('address')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">البريد الإلكتروني الرسمي</label>
                        <input type="email" name="email" placeholder="example@email.com"
                            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-500">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">رقم موبايل المسؤول</label>
                        <input type="text" name="phone" placeholder="رقم الموبايل"
                            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-500">
                        @error('phone')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">اسم مسؤول الحساب</label>
                        <input type="text" name="name" placeholder="مثال: سراج محمد"
                            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-500">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">كلمة المرور</label>
                        <input type="password" name="password" placeholder="********"
                            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-500">
                        @error(' password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">تكرار كلمة المرور</label>
                        <input type="password" name="password_confirmation" placeholder="********"
                            class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="flex items-center gap-2 text-sm mt-2">
                    <input type="checkbox" required class="form-checkbox border-gray-300 text-blue-600">
                    <label class="text-gray-600">أوافق على الشروط والأحكام</label>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">إرسال بيانات
                    التسجيل</button>

                <div class="flex items-center gap-2 text-sm my-4">
                    <div class="flex-grow h-px bg-gray-300"></div>
                    أو
                    <div class="flex-grow h-px bg-gray-300"></div>
                </div>

                <button
                    class="w-full border border-gray-300 flex items-center justify-center gap-2 py-2 rounded hover:bg-gray-50 mb-2">
                    <img src="https://img.icons8.com/color/48/google-logo.png" class="w-5 h-5" />
                    المتابعة من خلال Google
                </button>

                <button
                    class="w-full border border-gray-300 flex items-center justify-center gap-2 py-2 rounded hover:bg-gray-50">
                    <img src="https://img.icons8.com/ios-filled/50/000000/mac-os.png" class="w-5 h-5" />
                    Apple
                </button>

                <p class="text-sm text-center mt-6">
                    ليس لديك حساب؟ <a href="{{ route('login') }}" class="text-blue-600 hover:underline">حساب جديد</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>
