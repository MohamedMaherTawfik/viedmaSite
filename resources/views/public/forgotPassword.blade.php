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
        {{-- Success Message --}}


        <!-- Left Illustration -->
        <div class="bg-[#f8f6f4] flex items-center justify-center p-10">
            <img src="{{ asset('images/Ai-removebg-preview.png') }}" alt="login illustration" class="w-full max-w-md">
        </div>

        <!-- Right Form -->
        <div class="p-10 flex flex-col justify-center">
            <div class="flex items-center mb-4 self-center">
                <x-logo-component></x-logo-component>
            </div>
            <h2 class="text-2xl font-bold mb-1 self-center">نسيت كلمه المرور</h2>
            <p class="text-sm text-gray-500 mb-6 self-center">
                الرجاء ادخال البريد الالكتروني الخاص بك
            </p>


            <form method="POST" action="{{ route('forgot.password.verify') }}" class="w-full text-right">
                @csrf

                <!-- البريد الإلكتروني -->
                <label class="text-sm font-medium mb-1 text-right w-full block">البريد الإلكتروني</label>
                <input type="email" placeholder="youremail@email.com" name="email"
                    class="mb-4 border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                @error('email')
                    <span>{{ $message }}</span>
                @enderror
                <!-- زر الدخول -->
                <button type="submit"
                    class="bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200 w-full mb-4">
                    تسجيل الدخول
                </button>
            </form>


            <p class="text-center text-sm mt-6">
                ليس لديك حساب؟ <a href="{{ route('register') }}" class="text-blue-600 hover:underline">حساب جديد</a>
                <hr class="mt-2">
            </p>
        </div>
    </div>
</body>


</html>
