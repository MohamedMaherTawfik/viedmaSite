<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('main.register.title') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-200 min-h-screen">

    <div class="bg-white w-full min-h-screen grid grid-cols-1 md:grid-cols-2">

        <!-- Right Form -->
        <div class="p-6 flex flex-col justify-center text-right">

            <!-- Header with Title + Dropdown -->
            <div class="flex justify-between items-center w-full mb-4">

                <!-- Title -->
                <h2 class="text-2xl font-bold">{{ __('main.register.title') }}</h2>

                <!-- Dropdown -->
                <div x-data="{ open: false }" class="relative inline-block text-left">

                    <button
                        @click="open = !open"
                        class="inline-flex items-center justify-between w-55 rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium hover:bg-gray-100"
                    >
                        <span>{{ __('messages.Choose_register') }}</span>

                        <!-- Arrow -->
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

            <!-- Form -->
            @php
                use App\Models\school;
                $schools = school::get();
            @endphp

           <form method="POST" action="{{ route('parent.register.store') }}" class="w-full text-right text-sm">
    @csrf

    <div class="mb-4 md:flex md:gap-4">
        <!-- الاسم بالكامل / Full Name -->
        <div class="md:w-1/2 w-full mb-3 md:mb-0">
            <label class="text-xs font-medium mb-1 block">{{ __('messages.full_name') }}</label>
            <input type="text" placeholder="{{ __('messages.full_name') }}" name="name"
                class="border px-3 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                value="{{ old('name') }}">
        </div>

        <!-- المدرسة / School -->
        <div class="md:w-1/2 w-full">
            <label class="text-xs font-medium mb-1 block">{{ __('messages.school') }}</label>
            <select name="school_id"
                class="border px-3 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                <option value="">{{ __('messages.choose_school') }}</option>
                @foreach ($schools as $school)
                    <option value="{{ $school->id }}" {{ old('school_id') == $school->id ? 'selected' : '' }}>
                        {{ $school->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- البريد الإلكتروني / Email -->
    <label class="text-xs font-medium w-full">{{ __('messages.email') }}</label>
    <input type="email" name="email" placeholder="{{ __('messages.email') }}"
        class="mb-4 border px-3 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
        value="{{ old('email') }}">

    <!-- رقم الهاتف / Phone -->
    <label class="text-xs font-medium w-full">{{ __('messages.phone') }}</label>
    <input type="text" name="phone" placeholder="{{ __('messages.phone') }}"
        class="mb-4 border px-3 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
        value="{{ old('phone') }}">

    <!-- كلمة المرور / Password -->
    <label class="text-xs font-medium w-full">{{ __('messages.password') }}</label>
    <input type="password" name="password" placeholder="{{ __('messages.password') }}"
        class="mb-4 border px-3 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">

    <!-- تكرار كلمة المرور / Confirm Password -->
    <label class="text-xs font-medium w-full">{{ __('messages.password_confirm') }}</label>
    <input type="password" name="password_confirmation" placeholder="{{ __('messages.password_confirm') }}"
        class="mb-5 border px-3 py-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">

    <!-- Submit Button -->
    <button type="submit"
        class="bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200 w-full text-sm mb-3">
        {{ __('messages.submit') }}
    </button>

    <!-- Already have account? -->
    <p class="text-xs mt-3 text-center w-full">
        {{ __('messages.have_account') }}
        <a href="{{ route('parent.login') }}" class="text-blue-600 hover:underline">{{ __('messages.login') }}</a>
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
