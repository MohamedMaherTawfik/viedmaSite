<x-layout title="لوحه تحكم المعلم ">

    <!-- Sidebar -->
    <x-trainer-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-teacher-header />
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

            @if ($course->video_url)
                @php
                    // استخراج ID الفيديو من لينك YouTube
                    preg_match('/v=([^&]+)/', $course->video_url, $matches);
                    $videoId = $matches[1] ?? null;
                @endphp

                @if ($videoId)
                    <div class="w-full h-screen">
                        <iframe class="w-full h-full rounded-xl"
                            src="https://www.youtube.com/embed/{{ $videoId }}?controls=1&modestbranding=1&rel=0&showinfo=0&iv_load_policy=3&fs=0&disablekb=1"
                            title="YouTube video player" frameborder="0" allow="autoplay; encrypted-media"
                            allowfullscreen>
                        </iframe>
                    </div>
                @else
                    <p class="text-center text-red-600">❌ لا يمكن عرض الفيديو — رابط غير صالح</p>
                @endif
            @endif





        </main>
    </div>

</x-layout>
