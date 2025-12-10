<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('main.admin_login') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen -mt-16">
    {{-- <!-- Big image -->
    <img src="{{ asset('images/Ai-removebg-preview.png') }}" alt="{{ __('main.big_image') }}" class="w-36 h-48 mb-6"> --}}

    <!-- Centered form -->
    <form class="bg-white p-6 rounded-xl shadow-lg w-80" action="{{ route('admin.login.store') }}" method="POST">
        @csrf
        <h2 class="text-xl font-bold mb-4 text-center">{{ __('main.login') }}</h2>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('main.email') }}</label>
            <input type="email" id="email" name="email" placeholder="{{ __('main.email_placeholder') }}"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">{{ __('main.password') }}</label>
            <input type="password" id="password" name="password" placeholder="{{ __('main.password_placeholder') }}"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
            {{ __('main.login_button') }}
        </button>
    </form>
</body>

</html>
