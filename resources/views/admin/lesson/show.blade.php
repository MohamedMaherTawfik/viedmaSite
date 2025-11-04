<x-layout title="لوحه تحكم المعلم ">

    <!-- Sidebar -->
    <x-admin-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-admin-header />

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

            <!-- 🎬 Hero Section with controllable video -->
            <section x-show="activeSection === 'home'" class="relative w-full flex justify-center items-center py-10">
                <div class="relative w-full max-w-5xl rounded-2xl overflow-hidden shadow-lg">
                    <video controls class="w-full h-auto rounded-2xl"
                        style="max-height: 80vh; background-color: black;">
                        <source src="{{ asset('storage/' . $course->video_url) }}" type="video/mp4">
                        متصفحك لا يدعم تشغيل الفيديو.
                    </video>
                </div>
            </section>

        </main>
    </div>

</x-layout>
