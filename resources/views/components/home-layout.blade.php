<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viedma</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- إعداد Tailwind لدعم RTL -->
    <script>
        tailwind.config = {
            corePlugins: {
                preflight: true,
            },
            theme: {
                extend: {},
            },
            rtl: {{ app()->getLocale() === 'ar' ? 'true' : 'false' }},
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <!-- Navbar -->
    <x-navbar />

    <!-- Main Content Container -->
    <div class="flex flex-col min-h-screen">
        <!-- Main Slot Content (grows to push footer down) -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <hr>
        <x-footer />
    </div>
</body>

</html>
