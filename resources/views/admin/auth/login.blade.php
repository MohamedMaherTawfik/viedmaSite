<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centered Form with Images</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen -mt-16">
    <!-- Big image -->
    <img src="{{ asset('auth/rendered_page.png') }}" alt="Big Image" class="w-64 h-48 mb-6">

    <!-- Centered form -->
    <form class="bg-white p-6 rounded-xl shadow-lg w-80" action="{{ route('admin.login.store') }}" method="POST">
        @csrf
        <h2 class="text-xl font-bold mb-4 text-center">Login</h2>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
            <input type="email" id="email" name="email" placeholder="example@mail.com"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">كلمة المرور</label>
            <input type="password" id="password" name="password" placeholder="********"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
            دخول
        </button>
    </form>
</body>


</html>
