<section x-show="activeSection === 'home'" x-init="$nextTick(() => { $el.querySelector('video')?.play() })" class="relative w-full h-screen overflow-hidden">
    <video autoplay playsinline muted class="absolute inset-0 w-full h-full object-cover">
        <source src="{{ asset('video/VIEDMA.mp4') }}" type="video/mp4">
        متصفحك لا يدعم تشغيل الفيديو.
    </video>
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
</section>
