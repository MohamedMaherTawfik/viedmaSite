<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>teacher Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-gray-900 via-gray-900 to-indigo-900 min-h-screen flex items-center justify-center">
    {{-- Success Message --}}
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

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 space-y-6" style="background-color: #00000062;">
        <h2 class="text-3xl font-bold text-center text-white">Create Account</h2>

        <form class="space-y-4" action="{{ route('teacher.info') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label class="block text-sm font-medium text-white mb-1">phone</label>
                <input type="text" name="phone" placeholder="Enter Userphone"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                @error('phone')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-white mb-1">topic</label>
                <input type="text" name="topics" placeholder="Enter topic"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                @error('topics')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>


            <div class="flex justify-center">
                <button type="submit" class="py-2 px-4 text-white rounded-lg hover:bg-purple-700 transition"
                    style="width: 25%; background-color: rgba(100, 0, 167, 0.685); ">
                    Register
                </button>
            </div>
        </form>

        <p class="text-center text-sm text-gray-600">
            Already have an account?
            <a href="login.html" class="text-purple-600 hover:underline">Login</a>
        </p>
    </div>

</body>

</html>
