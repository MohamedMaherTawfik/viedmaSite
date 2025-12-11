<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.register') }}</title>
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

        <!-- Right Form -->
        <div class="p-10 flex flex-col justify-center items-start text-right">
            <div class="flex items-center mb-4 self-center">
                <x-logo-component></x-logo-component>
            </div>

            <div class="flex justify-between items-center w-full mb-4">

              <!-- عنوان Create Account أو Register -->
                <h2 class="text-2xl font-bold">{{ __('main.register.title') }}</h2>
                <!-- الدروب داون -->
                 <div x-data="{ open: false }" class="relative inline-block text-left">

                <button
                    @click="open = !open"
                    class="inline-flex items-center justify-between w-40 rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium hover:bg-gray-100"
                >
                    <span>{{ __('messages.Choose_register') }}</span>

                    <!-- السهم -->
                    <svg x-bind:class="open ? 'rotate-180' : ''"
                        class="w-4 h-4 transition-transform duration-200"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div
                    x-show="open"
                    @click.away="open = false"
                    x-transition
                    class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5"
                >
                        <div class="py-1">
                            <a href="{{ route('register') }}" class="block px-4 py-2 hover:bg-gray-100">
                                {{ __('messages.user') }}
                            </a>

                            {{-- <a href="{{ route('school.login') }}" class="block px-4 py-2 hover:bg-gray-100">
                                {{ __('messages.school_login') }}
                            </a> --}}

                            <a href="{{ route('trainer.register.form') }}" class="block px-4 py-2 hover:bg-gray-100">
                                {{ __('messages.trainer_login') }}
                            </a>

                            <a href="{{ route('parent.register') }}" class="block px-4 py-2 hover:bg-gray-100">
                                {{ __('messages.parent_login') }}
                            </a>
                        </div>

                </div>
            </div>


        </div>



            <p class="text-sm text-gray-500 mb-6 self-start">
                {{ __('main.register.subtitle') }}
            </p>

            <form method="POST" action="{{ route('register.store') }}" class="w-full text-right">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- الاسم الكامل -->
                    <div>
                        <label class="text-xs font-medium mb-1 w-full self-start">
                            {{ __('main.register.full_name') }}
                        </label>
                        <input type="text" name="name" placeholder="{{ __('main.register.full_name') }}"
                            class="mb-4 border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        @error('name')
                            <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- الرقم القومي -->
                    <div>
                        <label class="text-xs font-medium mb-1 w-full self-start">
                            {{ __('main.register.national_id') }}
                        </label>
                        <input type="text" name="national_id" placeholder="{{ __('main.register.national_id') }}"
                            class="mb-4 border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        @error('national_id')
                            <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- الجنسية -->
                    <div>
                        <label class="text-xs font-medium mb-1 w-full self-start">
                            {{ __('main.register.nationality') }}
                        </label>
                        <input type="text" name="nationallity" placeholder="{{ __('main.register.nationality') }}"
                            class="mb-4 border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        @error('nationallity')
                            <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- المرحلة الدراسية -->
                    <div>
                        <label class="text-xs font-medium mb-1 w-full self-start">
                            {{ __('main.register.academic_stage') }}
                        </label>
                        <input type="text" name="academic_stage" placeholder="{{ __('main.register.academic_stage') }}"
                            class="mb-4 border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        @error('academic_stage')
                            <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- المدرسة -->
                    <div>
                        <label class="text-xs font-medium mb-1 w-full self-start">
                            {{ __('main.register.school') }}
                        </label>
                        <select name="school_id"
                            class="mb-4 border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            <option value="">{{ __('main.register.choose_school') }}</option>
                            @foreach ($schools as $school)
                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                            @endforeach
                        </select>
                        @error('school_id')
                            <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- البريد الإلكتروني -->
                    <div>
                        <label class="text-xs font-medium mb-1 w-full self-start">
                            {{ __('main.register.email') }}
                        </label>
                        <input type="email" name="email" placeholder="{{ __('main.register.email') }}"
                            class="mb-4 border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        @error('email')
                            <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- كلمة المرور -->
                    <div>
                        <label class="text-xs font-medium mb-1 w-full self-start">
                            {{ __('main.register.password') }}
                        </label>
                        <input type="password" name="password" placeholder="{{ __('main.register.password') }}"
                            class="mb-4 border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        @error('password')
                            <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- تأكيد كلمة المرور -->
                    <div>
                        <label class="text-xs font-medium mb-1 w-full self-start">
                            {{ __('main.register.password_confirm') }}
                        </label>
                        <input type="password" name="password_confirmation"
                            placeholder="{{ __('main.register.password_confirm') }}"
                            class="mb-4 border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>

                </div>

                <button type="submit"
                    class="bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200 w-full mt-4">
                    {{ __('main.register.submit') }}
                </button>
            </form>
        </div>

        <!-- Left Illustration -->
        <div class="bg-[#f8f6f4] flex items-center justify-center p-10">
            <img src="{{ asset('images/Ai-removebg-preview.png') }}" alt="login illustration" class="w-full max-w-md">
        </div>
    </div>

    {{-- alpine cdn --}}
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</body>

</html>
