<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

</head>

<body class="bg-gray-200 min-h-screen">

    <div class="bg-white w-full min-h-screen grid grid-cols-1 md:grid-cols-2">

        <!-- Right Form -->
        <div class="p-6 flex flex-col justify-center text-right">
            <div class="flex items-center gap-2 mb-4 self-center">
                <img src="{{ asset('auth/rendered_page.png') }}" alt="robot" class="w-48 h-32">
            </div>

            @php
                use App\Models\school;
                $schools = school::get();
            @endphp

            <form method="POST" action="{{ route('parent.register.store') }}" class="w-full text-right text-sm">
                @csrf

                <div class="mb-4 md:flex md:gap-4">
                    <div class="md:w-1/2 w-full mb-3 md:mb-0">
                        <label class="text-xs font-medium mb-1 block">الاسم بالكامل</label>
                        <input type="text" placeholder="username" name="name"
                            class="border px-3 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                            value="{{ old('name') }}">
                    </div>

                    <div class="md:w-1/2 w-full">
                        <label class="text-xs font-medium mb-1 block">المدرسة</label>
                        <select name="school_id"
                            class="border px-3 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            <option value="">اختر المدرسة</option>
                            @foreach ($schools as $school)
                                <option value="{{ $school->id }}"
                                    {{ old('school_id') == $school->id ? 'selected' : '' }}>
                                    {{ $school->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <label class="text-xs font-medium  w-full self-start">البريد الإلكتروني</label>
                <input type="email" placeholder="example@email.com" name="email"
                    class="mb-4 border px-3 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    value="{{ old('email') }}">

                <label class="text-xs font-medium  w-full self-start">رقم الهاتف</label>
                <input type="text" placeholder="01012345678" name="phone"
                    class="mb-4 border px-3 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    value="{{ old('phone') }}">

                <label class="text-xs font-medium  w-full self-start">كلمة المرور</label>
                <input type="password" placeholder="********" name="password"
                    class="mb-4 border px-3 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">

                <label class="text-xs font-medium  w-full self-start">تكرار كلمة المرور</label>
                <input type="password" placeholder="********" name="password_confirmation"
                    class="mb-5 border px-3 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">

                <button type="submit"
                    class="bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200 w-full text-sm mb-3">
                    ارسال بيانات التسجيل
                </button>

                <p class="text-xs mt-3 text-center w-full">
                    لديك حساب؟ <a href="{{ route('parent.login') }}" class="text-blue-600 hover:underline">تسجيل
                        دخول</a>
                </p>
            </form>
        </div>

        <!-- Left Illustration -->
        <div class="bg-[#f8f6f4] flex items-center justify-center p-10">
            <img src="{{ asset('images/Ai-removebg-preview.png') }}" alt="login illustration" class="w-72 max-w-full">
        </div>
    </div>

</body>

</html>
