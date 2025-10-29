<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachio - Educational Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom CSS -->
    <style>
        .hero-pattern {
            background-image: radial-gradient(#3b82f6 0.5px, transparent 0.5px);
            background-size: 10px 10px;
            opacity: 0.1;
        }
    </style>
</head>

<body class="bg-white" x-data="courseLoader()" x-init="startLoading()" x-cloak>
    <!-- Navigation Bar -->
    <x-navbar />

    <header class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800 text-center mt-6">{{ __('messages.enrolled_courses') }}</h1>
    </header>

    <!-- Loading Spinner -->
    <div x-show="isLoading" class="flex justify-center items-center min-h-[300px]">
        <svg class="animate-spin h-12 w-12 text-[#176b98]" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
            </circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
    </div>

    <!-- Courses Grid -->
    <section x-show="!isLoading"
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mx-auto transition-all duration-300">

        @foreach ($courses as $course)
            <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition mb-5">
                <div class="rounded-xl overflow-hidden shadow-xl w-128 h-60">
                    @if (!empty($course->cover_photo))
                        <img src="{{ asset('storage/' . $course->cover_photo) }}"
                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                            alt="{{ $course->title }}">
                    @else
                        <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBwgHBgkIBwgKCgkLDRYPDQwMDRsUFRAWIB0iIiAdHx8kKDQsJCYxJx8fLT0tMTU3Ojo6Iys/RD84QzQ5OjcBCgoKDQwNGg8PGjclHyU3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3N//AABEIALcAwgMBIgACEQEDEQH/xAAaAAEAAwEBAQAAAAAAAAAAAAAAAwQFAQIH/8QAMxABAAIAAwQIBgIBBQAAAAAAAAECAwQRElJxkRMhMTNBQlFhFDI0gaGiIrFEBSNicoL/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8A+zgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA5N6V+a1eYOiG2Zw6+fl1vE5ynlrM/gFkUrZ2/lpX7zq7gZi98aIvbWs69UQC4AAAAAAAAAAAAAAaoM5N+jia200lRiLWt/GLWnmDStj4de28aorZzDr4WnhCrGVxreTTj1JK5O/mtFfyD1bOz5aR95R2zOJaO2I4Qnrk6R817T+EkZbBjy68ZBQnEvb5r25lcO1vLaWlFYr8sRD0ChXKYlvCK8Ze4yU+fEj7RK4ArRlKVidJmZVMOdMWvtZqR2szHrpi2j0nUGnrtaT7DlJ2qxPrDoAAAAAAAAAAAAIszG1g29o1/Kpk7bOYj3hftGtZj1hmYX8cWk+kxANRUx8zfCxZita/dbjriJZ2b7+3CAe/jcTdqfG4m7VJh5fCthRa396O9Bl979wRfG4m7U+NxN2qXoMvvfu50GX3v3BH8bibtT43E3apOgy+9+50GX3v3BH8biR4VQYl5xLbVtPst9Bl979zoMvvfuCGmavWuzXZ6vV6+MxN2qXoMvvfujzOBTDwta9vHUEuWx5xbzFtPl8FhRyPe24QvAAAAAAAAAAAMvGjYxbR6Tq1Gfna/70zvAv064rwhQzff24Qt5S21g19upUzff24QCePop4KOkzaIjtXo+ingqYVoriVmeyJiQWK5O011m3XPgr4mHbCtpbqn1alZjZ1r49ajnb1nE2Y7YBWAAFnL5eL9d+z0eMxgThTrHXE+IIV7N/TRxj+lFezf00cY/oEWR723CF5RyPe24QvAAAAAAAAAAAKefjTYt/5XOzrV85XXAj2kHn/T7a0mvpZDm+/twh7yE6Yk19YeM339uEAn/wp4KK9/hTwUQd2rRGkWtEemrmr1TCvfWa11c7J07LR6g4sZXBjFnbt1UjxecvgTjW6vljtloUiK12a+AOxERGleyOxy9YvWdqNXQGZjYXR2ms8Y91rN/TRxj+k2LhVxa6T2oc5/HLxHpMQCLI97bhC8o5HvbcIXgAAAAAAAAAAEePG3gWj0iUhPXGgM7LW0x68dDN9/bhCKJnDvrHbE6vV7Ta+1bxjwBcjWcnpHbojwMrPVbF6v8Aj6rGW7inBIBEREaVjTRHjYFMT5o090gDzSsUrs1jTT8vQAAAK+e7j7wsK+e7j7wCHI97bhC8o5HvbcIXgAAAAAAAAAAAAV/hKWtM2meudVXM1imNNa+DScmlbeUGXGLesfxtaHemxN+ebS2K7teRsV3a8gZvTYm/PM6bE355tLYru15GxXdryBm9Nib88zpsTfnm0tiu7XkbFd2vIGb02JvzzOmxN+ebS2K7teRsV3a8gZvTYnhiTzctiXvGlpmdPdp7Fd2vI2K7teQKeQ7yf+q85Fa7scnQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAf//Z"
                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                            alt="Default Image">
                    @endif
                </div>


                <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $course->name }}</h2>
                <p class="text-gray-600 mb-4">{{ $course->description }}</p>

                <!-- Align button to the right -->
                <div class="flex justify-end">
                    <a href="{{ route('web.courses.enrolled.show', $course) }}"
                        class="bg-[#176b98] text-white px-4 py-2 rounded-xl hover:bg-[#074F75FF]">{{ __('messages.showCourse') }}</a>
                </div>
            </div>
        @endforeach
    </section>

    <!-- Footer -->
    <x-footer />

    <!-- AlpineJS & Loader Logic -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        function courseLoader() {
            return {
                isLoading: true,
                startLoading() {
                    setTimeout(() => {
                        this.isLoading = false;
                    }, 1000);
                }
            };
        }
    </script>
</body>

</html>
