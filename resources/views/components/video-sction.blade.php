<!-- Hero Section -->
<section x-show="activeSection === 'home'" class="relative w-full h-screen overflow-hidden">
    <!-- خلفية الفيديو -->
    <video autoplay loop playsinline class="absolute inset-0 w-full h-full object-cover">
        <source src="{{ asset('video/VIEDMA.mp4') }}" type="video/mp4">
        متصفحك لا يدعم تشغيل الفيديو.
    </video>

    <!-- طبقة التعتيم (اختياري لتوضيح النص) -->
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
</section>
