@php
    // استخراج videoId من رابط YouTube
    preg_match('/v=([a-zA-Z0-9_-]+)/', $course->video_url, $matches);
    $videoId = $matches[1] ?? null;
@endphp

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>{{ $course->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-black text-white flex flex-col min-h-screen">
    {{-- Navbar --}}
    <x-navbar1 />

    {{-- Main Section --}}
    <main class="flex-1 flex items-center justify-center bg-black mb-10">
        @if ($videoId)
            <div x-data="youtubePlayer('{{ $videoId }}')"
                class="w-[60vw] h-[60vh] relative rounded-2xl overflow-hidden shadow-2xl bg-black">
                <!-- YouTube iframe -->
                <div class="relative w-full h-full">
                    <iframe id="yt-player" class="w-full h-full rounded-2xl"
                        src="https://www.youtube.com/embed/{{ $videoId }}?enablejsapi=1&modestbranding=1&rel=0&showinfo=0&iv_load_policy=3&fs=0&controls=0"
                        frameborder="0" allow="autoplay; encrypted-media; picture-in-picture"></iframe>
                </div>

                <!-- Custom Controls -->
                <div
                    class="absolute bottom-0 left-0 w-full bg-black/60 text-white p-3 flex items-center gap-3 backdrop-blur-sm">
                    <!-- Play / Pause -->
                    <button @click="togglePlay" class="px-4 py-2 bg-gray-800 rounded-lg hover:bg-gray-700 transition">▶️
                        / ⏸️</button>

                    <!-- Backward 5s -->
                    <button @click="seek(-5)" class="px-4 py-2 bg-gray-800 rounded-lg hover:bg-gray-700 transition">⏪
                        -5s</button>

                    <!-- Forward 5s -->
                    <button @click="seek(5)" class="px-4 py-2 bg-gray-800 rounded-lg hover:bg-gray-700 transition">⏩
                        +5s</button>

                    <!-- Progress bar -->
                    <input type="range" min="0" max="100" step="0.1" x-model="progress"
                        @input="updateProgress"
                        class="flex-1 accent-red-500 cursor-pointer h-2 rounded-lg bg-gray-600 appearance-none">

                    <!-- Fullscreen -->
                    <button @click="toggleFullscreen"
                        class="px-4 py-2 bg-gray-800 rounded-lg hover:bg-gray-700 transition">⛶</button>
                </div>
            </div>
        @else
            <p class="text-center text-red-500 text-lg font-semibold mt-6">
                ❌ لا يمكن عرض الفيديو — رابط غير صالح
            </p>
        @endif
    </main>

    {{-- Footer --}}
    <x-footer />

    <!-- YouTube API -->
    <script src="https://www.youtube.com/iframe_api"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        let player;

        function onYouTubeIframeAPIReady() {
            player = new YT.Player('yt-player', {
                events: {
                    onReady: () => console.log("Player ready")
                }
            });
        }

        document.addEventListener('alpine:init', () => {
            Alpine.data('youtubePlayer', (videoId) => ({
                progress: 0,
                isPlaying: false,
                duration: 0,
                interval: null,

                togglePlay() {
                    if (this.isPlaying) player.pauseVideo();
                    else player.playVideo();
                    this.isPlaying = !this.isPlaying;
                },

                seek(seconds) {
                    const current = player.getCurrentTime();
                    player.seekTo(current + seconds, true);
                },

                updateProgress() {
                    const newTime = (this.progress / 100) * this.duration;
                    player.seekTo(newTime, true);
                },

                toggleFullscreen() {
                    const iframe = document.getElementById('yt-player');
                    if (!document.fullscreenElement) iframe.requestFullscreen();
                    else document.exitFullscreen();
                },

                init() {
                    const waitPlayer = setInterval(() => {
                        if (player && player.getDuration) {
                            this.duration = player.getDuration();
                            clearInterval(waitPlayer);
                            this.interval = setInterval(() => {
                                const current = player.getCurrentTime();
                                this.progress = (current / this.duration) * 100;
                            }, 500);
                        }
                    }, 1000);
                }
            }));
        });
    </script>
</body>

</html>
