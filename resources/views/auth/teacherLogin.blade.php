<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>teacher Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-gray-900 via-gray-900 to-indigo-900 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 space-y-6" style="background-color: #00000062;">
        <h2 class="text-3xl font-bold text-center text-white">Create Account</h2>

        <form class="space-y-4" action="{{ route('teacher') }}" method="POST" enctype="multipart/form-data">
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
                <input type="text" name="topic" placeholder="Enter topic"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                @error('topic')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>


            <div class="w-full space-y-4">
                <label class="block w-full">
                    <span class="text-sm text-gray-700">Upload CV</span>
                    <input type="file" name="cv" accept=".pdf,.doc,.docx"
                        class="mt-1 block w-full text-sm text-gray-500
        file:mr-4 file:py-2 file:px-4
        file:rounded-lg file:border-0
        file:text-sm file:font-semibold
        file:bg-purple-600 file:text-white
        hover:file:bg-purple-700
      " />
                    @error('cv')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </label>

                <label class="block w-full">
                    <span class="text-sm text-gray-700">Upload Certificate if exist</span>
                    <input type="file" name="certificate"
                        class="mt-1 block w-full text-sm text-gray-500
        file:mr-4 file:py-2 file:px-4
        file:rounded-lg file:border-0
        file:text-sm file:font-semibold
        file:bg-purple-600 file:text-white
        hover:file:bg-purple-700
      " />
                    @error('certificate')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </label>
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
