<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Success</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-2xl p-8 text-center max-w-sm w-full">
        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="green" class="mx-auto"
            viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 8 0a8 8 0 0 1 8 8zM6.97 11.03a.75.75 0 0 0 1.08 0l4-4a.75.75 0 1 0-1.08-1.04L7.5 9.44l-1.47-1.47a.75.75 0 1 0-1.06 1.06l2 2z" />
        </svg>
        <h2 class="mt-4 text-2xl font-semibold text-green-600">Success!</h2>
        <p class="mt-2 text-gray-700">Your request will be reviewed and you will be responded to as soon as possible.
        </p>
        <a href="{{ route('home') }}"
            class="inline-block mt-4 bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition">Go
            to Home</a>
    </div>
</body>

</html>
