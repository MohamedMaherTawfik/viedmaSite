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
        <div class="p-10 flex flex-col justify-start items-start text-right relative">
            <!-- صورة الروبوت في منتصف القسم -->
            <div class="absolute top-4 left-1/2 transform -translate-x-1/2">
                <img src="{{ asset('auth/rendered_page.png') }}" alt="robot" class="w-72 h-48">
            </div>

            <!-- تباعد أسفل الصورة -->
            <div class="mt-56 w-full">

                <h2 class="text-2xl font-bold self-start">انشاء حساب</h2>
                <p class="text-sm text-gray-500 mb-6 self-start">
                    الرجاء تسجيل الدخول لمتابعة إلى حسابك.
                </p>

                @php
                    use App\Models\school;
                    $schools = school::get();
                @endphp

                <form method="POST" action="{{ route('trainer.register') }}" enctype="multipart/form-data"
                    class="w-full text-right">
                    @csrf

                    <!-- الاسم الكامل + البريد الإلكتروني في نفس الصف -->
                    <div class="flex gap-4 mb-2 ">
                        <div class="w-1/2">
                            <label class="text-sm font-medium block">الاسم بالكامل</label>
                            <input type="text" name="name" placeholder="ادخل اسمك الثلاثي"
                                class="border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('name')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="w-1/2">
                            <label class="text-sm font-medium block">البريد الإلكتروني</label>
                            <input type="email" name="email" placeholder="example@email.com"
                                class="border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('email')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- المدرسة + رقم الهاتف في نفس الصف -->
                    <div class="flex gap-4 mb-1">
                        <!-- المدرسة -->
                        <div class="w-1/2">
                            <label class="text-xs font-medium mb-1 block">المدرسة</label>
                            <select name="school_id"
                                class="border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                <option value="">اختر المدرسة</option>
                                @foreach ($schools as $school)
                                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                                @endforeach
                            </select>
                            @error('school_id')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- رقم الهاتف -->
                        <div class="w-1/2">
                            <label class="text-sm font-medium block">رقم الهاتف</label>
                            <input type="text" name="phone" placeholder="رقم الهاتف"
                                class="border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('phone')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>



                    <!-- السيرة الذاتية + الشهادات العلمية -->
                    <div class="flex gap-4 mb-2">
                        <div class="w-1/2">
                            <label class="text-sm font-medium block">السيرة الذاتية</label>
                            <input type="file" name="cv"
                                class="border border-dashed border-2 border-green-400 rounded w-full px-4 py-2 bg-green-50 text-green-700">
                            @error('cv')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="w-1/2">
                            <label class="text-sm font-medium block">الشهادات العلمية</label>
                            <input type="file" name="certificates[]"
                                class="border border-dashed border-2 border-green-400 rounded w-full px-4 py-2 bg-green-50 text-green-700"
                                multiple>
                            @error('certificate')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- كلمة المرور وتأكيدها في نفس الصف -->
                    <div class="flex gap-4 mb-1">
                        <!-- كلمة المرور -->
                        <div class="w-1/2">
                            <label class="text-sm font-medium block">كلمة المرور</label>
                            <input type="password" name="password" placeholder="********"
                                class="border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('password')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- تأكيد كلمة المرور -->
                        <div class="w-1/2">
                            <label class="text-sm font-medium block">تكرار كلمة المرور</label>
                            <input type="password" name="password_confirmation" placeholder="********"
                                class="border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>



                    <!-- الشروط -->
                    <div class="flex items-center mb-1">
                        <input type="checkbox" name="terms"
                            class="form-checkbox rounded border-gray-300 text-blue-600">
                        <span class="mr-2 text-sm">أوافق على الشروط والخصوصية</span>
                    </div>

                    <!-- زر التسجيل -->
                    <button type="submit"
                        class="bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200 w-full">
                        ارسال بيانات التسجيل
                    </button>
                </form>

                <!-- تسجيل باستخدام Google -->
                {{-- <div class="flex items-center gap-2 text-sm  w-full mt-4">
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
                    لديك حساب؟ <a href="{{ route('trainer.login.form') }}" class="text-blue-600 hover:underline">تسجيل
                        دخول</a>
                </p>
            </div>
        </div>

        <!-- Left Illustration (now second column in RTL) -->
        <div class="bg-[#f8f6f4] flex items-center justify-center p-10">
            <img src="{{ asset('auth/WhatsApp Image 2025-07-05 at 17.28.44_7ec5a7e4.jpg') }}" alt="login illustration"
                class="w-full max-w-md">
        </div>
    </div>
</body>

</html>
