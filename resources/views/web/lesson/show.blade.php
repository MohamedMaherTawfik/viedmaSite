<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>{{ $course->title ?? 'الفيديو' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-black text-white flex flex-col min-h-screen">

    {{-- ✅ Navbar لو حبيت --}}
    <x-navbar1 />

    <main class="flex-1 flex items-center justify-center bg-black">
        @php
            $url = $course->video_url;
            $isYoutube = str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be');
        @endphp

        @if ($url)
            @if ($isYoutube)
                {{-- 🎥 لو الرابط من يوتيوب --}}
                @php
                    // استخراج videoId سواء من youtu.be أو youtube.com
                    preg_match('/(youtu\.be\/|v=)([a-zA-Z0-9_-]+)/', $url, $matches);
                    $videoId = $matches[2] ?? null;
                @endphp

                @if ($videoId)
                    <iframe class="w-full h-screen"
                        src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=0&controls=1" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                @else
                    <p class="text-red-500 text-lg">❌ لا يمكن عرض الفيديو — رابط غير صالح</p>
                @endif
            @else
                {{-- 🎬 لو الفيديو مرفوع أو رابط مباشر --}}
                <video controls class="w-full h-screen object-contain bg-black">
                    <source src="{{ asset('storage/' . $url) }}" type="video/mp4">
                    متصفحك لا يدعم تشغيل الفيديو.
                </video>
            @endif
        @else
            <p class="text-red-500 text-lg">❌ لا يوجد فيديو لهذا الدرس</p>
        @endif
    </main>

    {{-- ✅ Footer لو حبيت --}}
    <x-footer />

    {{-- alpine cdn --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
