<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.user_register') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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
        <div class="p-10 flex flex-col justify-start items-start text-right relative">

            <!-- صورة الروبوت -->
            <div class="absolute top-4 left-1/2 transform -translate-x-1/2">
                <img src="{{ asset('auth/rendered_page.png') }}" alt="robot" class="w-72 h-48">
            </div>

            <div class="mt-56 w-full">

                <!-- عنوان Create Account + Dropdown -->
                <div class="flex justify-between items-center w-full mb-4">
                    <h2 class="text-2xl font-bold">{{ __('messages.user_register') }}</h2>

                    <!-- Dropdown -->
                    <div x-data="{ open: false }" class="relative inline-block text-left">
                        <button @click="open = !open"
                            class="inline-flex items-center justify-between w-44 rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium hover:bg-gray-100">
                            <span>{{ __('messages.Choose_register') }}</span>
                            <svg x-bind:class="open ? 'rotate-180' : ''"
                                class="w-4 h-4 transition-transform duration-200"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 z-10 mt-2 w-44 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                            <div class="py-1">
                                <a href="{{ route('register') }}"
                                    class="block px-4 py-2 hover:bg-gray-100">{{ __('messages.user_register') }}</a>
                                <a href="{{ route('trainer.register.form') }}"
                                    class="block px-4 py-2 hover:bg-gray-100">{{ __('messages.trainer_register') }}</a>
                                <a href="{{ route('parent.register') }}"
                                    class="block px-4 py-2 hover:bg-gray-100">{{ __('messages.parent_register') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="text-sm text-gray-500 mb-6 self-start">
                    الرجاء إدخال البيانات لإتمام التسجيل
                </p>

                @php
                    use App\Models\school;
                    $schools = school::get();
                @endphp

                <form method="POST" action="{{ route('trainer.register') }}" enctype="multipart/form-data"
                    class="w-full text-right">
                    @csrf

                    <!-- الاسم + البريد -->
                    <div class="flex gap-4 mb-2">
                        <div class="w-1/2">
                            <label class="text-sm font-medium block">{{ __('messages.full_name') }}</label>
                            <input type="text" name="name" placeholder="{{ __('messages.full_name') }}"
                                class="border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ old('name') }}">
                            @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div class="w-1/2">
                            <label class="text-sm font-medium block">{{ __('messages.email') }}</label>
                            <input type="email" name="email" placeholder="{{ __('messages.email') }}"
                                class="border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ old('email') }}">
                            @error('email') <span class="text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- المدرسة + الهاتف -->
                    <div class="flex gap-4 mb-2">
                        <div class="w-1/2">
                            <label class="text-xs font-medium mb-1 block">{{ __('messages.school') }}</label>
                            <select name="school_id"
                                class="border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                <option value="">{{ __('messages.choose_school') }}</option>
                                @foreach ($schools as $school)
                                    <option value="{{ $school->id }}" {{ old('school_id') == $school->id ? 'selected' : '' }}>
                                        {{ $school->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('school_id') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="w-1/2">
                            <label class="text-sm font-medium block">{{ __('messages.phone') }}</label>
                            <input type="text" name="phone" placeholder="{{ __('messages.phone') }}"
                                class="border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ old('phone') }}">
                            @error('phone') <span class="text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- السيرة الذاتية + الشهادات -->
                    <div class="flex gap-4 mb-2">
                        <div class="w-1/2">
                            <label class="text-sm font-medium block">{{ __('messages.cv') }}</label>
                            <input type="file" name="cv"
                                class="border border-dashed border-2 border-green-400 rounded w-full px-4 py-2 bg-green-50 text-green-700">
                            @error('cv') <span class="text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div class="w-1/2">
                            <label class="text-sm font-medium block">{{ __('messages.certificates') }}</label>
                            <input type="file" name="certificates[]" multiple
                                class="border border-dashed border-2 border-green-400 rounded w-full px-4 py-2 bg-green-50 text-green-700">
                            @error('certificate') <span class="text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- كلمة المرور + تأكيدها -->
                    <div class="flex gap-4 mb-2">
                        <div class="w-1/2">
                            <label class="text-sm font-medium block">{{ __('messages.password') }}</label>
                            <input type="password" name="password" placeholder="{{ __('messages.password') }}"
                                class="border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="w-1/2">
                            <label class="text-sm font-medium block">{{ __('messages.password_confirm') }}</label>
                            <input type="password" name="password_confirmation"
                                placeholder="{{ __('messages.password_confirm') }}"
                                class="border px-4 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <!-- الشروط -->
                    <div class="flex items-center mb-3">
                        <input type="checkbox" name="terms" class="form-checkbox rounded border-gray-300 text-blue-600">
                        <span class="mr-2 text-sm">{{ __('messages.terms') }}</span>
                    </div>

                    <!-- زر التسجيل -->
                    <button type="submit"
                        class="bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200 w-full mb-3">
                        {{ __('messages.submit') }}
                    </button>

                    <p class="text-sm mt-3 text-center w-full">
                        {{ __('messages.have_account') }}
                        <a href="{{ route('trainer.login.form') }}" class="text-blue-600 hover:underline">{{ __('messages.login') }}</a>
                    </p>
                </form>
            </div>
        </div>

        <!-- Left Illustration -->
        <div class="bg-[#f8f6f4] flex items-center justify-center p-10">
            <img src="{{ asset('images/Ai-removebg-preview.png') }}" alt="login illustration" class="w-full max-w-md">
        </div>
    </div>
</body>

</html>
