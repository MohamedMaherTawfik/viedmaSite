<!DOCTYPE html>
<html lang="ar" dir="rtl" x-data="{ activeTab: 'home' }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIEDMA - بوابة التعليم والتسوق الإلكتروني</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .nav-item {
            position: relative;
            padding-bottom: 5px;
        }

        .nav-item::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 0;
            height: 2px;
            background: #3B82F6;
            transition: width 0.3s ease;
        }

        .nav-item:hover::after {
            width: 100%;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .typewriter {
            overflow: hidden;
            border-right: .15em solid #3B82F6;
            white-space: nowrap;
            animation: typing 3.5s steps(40, end), blink-caret .75s step-end infinite;
        }

        @keyframes typing {
            from {
                width: 0
            }

            to {
                width: 100%
            }
        }

        @keyframes blink-caret {

            from,
            to {
                border-color: transparent
            }

            50% {
                border-color: #3B82F6;
            }
        }

        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .hero-pattern {
            background-color: #3b82f6;
            background-image: radial-gradient(at 47% 33%, hsl(197.95, 100%, 67%) 0, transparent 59%),
                radial-gradient(at 82% 65%, hsl(204.07, 100%, 60%) 0, transparent 55%);
        }
    </style>
</head>

<body class="min-h-screen flex flex-col" x-data="{
    activeSection: 'home',
    init() {
        // Intersection Observer for fade-in animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.fade-in').forEach((element) => {
            observer.observe(element);
        });
    }
}">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex-shrink-0">
                    <img src="{{ asset('auth/rendered_page.png') }}" alt="VIEDMA Logo" class="h-18 w-48">
                </div>
                <div class="hidden md:flex space-x-8 space-x-reverse">
                    <a href="#" class="nav-item text-blue-600 font-semibold"
                        @click="activeSection = 'home'">الرئيسية</a>
                    <a href="#" class="nav-item text-gray-600 hover:text-blue-600"
                        @click="activeSection = 'education'">التعليم</a>
                    <a href="#" class="nav-item text-gray-600 hover:text-blue-600"
                        @click="activeSection = 'ecommerce'">المتجر</a>
                    <a href="#" class="nav-item text-gray-600 hover:text-blue-600"
                        @click="activeSection = 'schools'">المدارس</a>
                    <a href="#" class="nav-item text-gray-600 hover:text-blue-600"
                        @click="activeSection = 'about'">عنّا</a>
                </div>
                <div class="md:hidden">
                    <button @click="open = !open" class="text-gray-500 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="open" class="md:hidden bg-white border-t" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-3"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-3">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 text-center">
                <a href="#" class="block px-3 py-2 text-blue-600 font-medium"
                    @click="activeSection = 'home'; open = false">الرئيسية</a>
                <a href="#" class="block px-3 py-2 text-gray-600 hover:text-blue-600"
                    @click="activeSection = 'education'; open = false">التعليم</a>
                <a href="#" class="block px-3 py-2 text-gray-600 hover:text-blue-600"
                    @click="activeSection = 'ecommerce'; open = false">المتجر</a>
                <a href="#" class="block px-3 py-2 text-gray-600 hover:text-blue-600"
                    @click="activeSection = 'schools'; open = false">المدارس</a>
                <a href="#" class="block px-3 py-2 text-gray-600 hover:text-blue-600"
                    @click="activeSection = 'about'; open = false">عنّا</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section x-show="activeSection === 'home'" class="hero-pattern text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0 fade-in">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 typewriter">مرحباً بكم في VIEDMA</h1>
                    <p class="text-xl mb-8">منصة متكاملة تجمع بين التعليم الإلكتروني، التسوق، وإدارة المدارس في مكان
                        واحد</p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('schools') }}"
                            class="bg-white text-blue-600 px-6 py-3 rounded-lg font-bold shadow-lg hover:bg-gray-100 transition duration-300">
                            ابدأ الرحلة التعليمية
                        </a>
                        <a href="{{ route('home') }}"
                            class="border-2 border-white text-white px-6 py-3 rounded-lg font-bold hover:bg-white hover:text-blue-600 transition duration-300">
                            تصفح المتجر
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center fade-in">
                    <div class="relative">
                        <div class="floating">
                            <img src="{{ asset('images/home.png') }}" alt="E-Learning" class="w-80 mx-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section x-show="activeSection === 'home'" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">خدماتنا</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Education Card -->
                <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false"
                    class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl overflow-hidden shadow-lg card-hover fade-in">
                    <div class="p-6">
                        <div class="flex justify-center mb-6">
                            <div class="w-20 h-20 rounded-full bg-blue-500 flex items-center justify-center text-white text-3xl"
                                :class="{ 'transform scale-110 transition duration-300': hover }">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-center mb-4 text-gray-800">منصة التعليم</h3>
                        <p class="text-gray-600 text-center mb-6">استكشف دوراتنا التفاعلية ووسّع معرفتك بمختلف المجالات
                            مع معلمين خبراء</p>
                        <a href="{{ route('schools') }}"
                            class="block text-center bg-blue-500 text-white py-2 px-4 rounded-lg font-semibold hover:bg-blue-600 transition duration-300">
                            ابدأ التعلم الآن
                        </a>
                    </div>
                </div>

                <!-- E-commerce Card -->
                <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false"
                    class="bg-gradient-to-br from-red-50 to-red-100 rounded-2xl overflow-hidden shadow-lg card-hover fade-in">
                    <div class="p-6">
                        <div class="flex justify-center mb-6">
                            <div class="w-20 h-20 rounded-full bg-red-500 flex items-center justify-center text-white text-3xl"
                                :class="{ 'transform scale-110 transition duration-300': hover }">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-center mb-4 text-gray-800">متجر إلكتروني</h3>
                        <p class="text-gray-600 text-center mb-6">تسوق أحدث المنتجات والمواد التعليمية بأسعار تنافسية
                            وتوصيل سريع</p>
                        <a href="{{ route('home') }}"
                            class="block text-center bg-red-500 text-white py-2 px-4 rounded-lg font-semibold hover:bg-red-600 transition duration-300">
                            تصفح المتجر
                        </a>
                    </div>
                </div>

                <!-- Schools Card -->
                <div x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false"
                    class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl overflow-hidden shadow-lg card-hover fade-in">
                    <div class="p-6">
                        <div class="flex justify-center mb-6">
                            <div class="w-20 h-20 rounded-full bg-green-500 flex items-center justify-center text-white text-3xl"
                                :class="{ 'transform scale-110 transition duration-300': hover }">
                                <i class="fas fa-school"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-center mb-4 text-gray-800">تعليم و تطوير مدرسين</h3>
                        <p class="text-gray-600 text-center mb-6">
                            نوفر برامج تدريبية متخصصة،
                            استخدام أحدث أساليب التدريس والتكنولوجيا في العملية التعليمية.
                        </p>

                        <a href="#"
                            class="block text-center bg-green-500 text-white py-2 px-4 rounded-lg font-semibold hover:bg-green-600 transition duration-300">
                            اكتشف المزيد
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Education Section -->
    <section x-show="activeSection === 'education'" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-8"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        class="py-16 bg-gradient-to-r from-blue-400 to-blue-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">منصة التعليم الإلكتروني</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-2xl font-bold mb-6">تعلم بأسلوب مبتكر وممتع</h3>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mt-1 mr-3 text-green-300"></i>
                            <span>آلاف الدورات في مختلف المجالات</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mt-1 mr-3 text-green-300"></i>
                            <span>معلمون خبراء من حول العالم</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mt-1 mr-3 text-green-300"></i>
                            <span>شهادات معتمدة بعد إتمام الدورات</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mt-1 mr-3 text-green-300"></i>
                            <span>مجتمعات تعلم تفاعلية</span>
                        </li>
                    </ul>
                    <a href="{{ route('schools') }}"
                        class="inline-block bg-white text-blue-600 px-6 py-3 rounded-lg font-bold shadow-lg hover:bg-gray-100 transition duration-300">
                        استكشف الدورات
                    </a>
                </div>

                <div class="flex justify-center">
                    <img src="{{ asset('images/elearn.png') }}" alt="E-Learning" class="w-80 floating">
                </div>
            </div>
        </div>
    </section>

    <!-- E-commerce Section -->
    <section x-show="activeSection === 'ecommerce'" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-8"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        class="py-16 bg-gradient-to-r from-red-400 to-red-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">متجر VIEDMA الإلكتروني</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="flex justify-center order-2 md:order-1">
                    <img src="{{ asset('images/store.png') }}" alt="E-Commerce" class="w-80 floating">
                </div>

                <div class="order-1 md:order-2">
                    <h3 class="text-2xl font-bold mb-6">تجربة تسوق فريدة</h3>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mt-1 mr-3 text-yellow-300"></i>
                            <span>منتجات تعليمية مبتكرة</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mt-1 mr-3 text-yellow-300"></i>
                            <span>أسعار تنافسية وعروض خاصة</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mt-1 mr-3 text-yellow-300"></i>
                            <span>توصيل سريع لكافة أنحاء الوطن</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mt-1 mr-3 text-yellow-300"></i>
                            <span>ضمان الجودة والاسترجاع السهل</span>
                        </li>
                    </ul>
                    <a href="{{ route('home') }}"
                        class="inline-block bg-white text-red-600 px-6 py-3 rounded-lg font-bold shadow-lg hover:bg-gray-100 transition duration-300">
                        ابدأ التسوق
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Schools Section -->
    <section x-show="activeSection === 'schools'" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-8"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        class="py-16 bg-gradient-to-r from-green-400 to-green-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">نظام إدارة المدارس</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-2xl font-bold mb-6">حول مدرستك إلى منصة تعليمية متكاملة</h3>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mt-1 mr-3 text-blue-300"></i>
                            <span>إدارة شاملة للطلاب والمعلمين</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mt-1 mr-3 text-blue-300"></i>
                            <span>تقارير أداء تفصيلية</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mt-1 mr-3 text-blue-300"></i>
                            <span>قنوات اتصال مع أولياء الأمور</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mt-1 mr-3 text-blue-300"></i>
                            <span>جدولة الحصص والامتحانات</span>
                        </li>
                    </ul>
                    <a href="#"
                        class="inline-block bg-white text-green-600 px-6 py-3 rounded-lg font-bold shadow-lg hover:bg-gray-100 transition duration-300">
                        تعرف على النظام
                    </a>
                </div>

                <div class="flex justify-center">
                    <img src="{{ asset('images/school.png') }}" alt="School System" class="w-80 floating">
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section x-show="activeSection === 'about'" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-8"
        x-transition:enter-end="opacity-100 transform translate-y-0" class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">عن VIEDMA</h2>

            <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div>
                        <h3 class="text-2xl font-bold mb-6 text-blue-600">رؤيتنا ورسالتنا</h3>
                        <p class="text-gray-700 mb-6">
                            تأسست VIEDMA بهدف تقديم حلول تعليمية وتقنية متكاملة تجمع بين منصة تعليمية متطورة، متجر
                            إلكتروني متميز، ونظام متكامل لإدارة المدارس. نؤمن بأن التعليم هو أساس تقدم المجتمعات ونسعى
                            لتوفير أدوات مبتكرة تسهم في تطوير العملية التعليمية.
                        </p>
                        <p class="text-gray-700">
                            نعمل على بناء جسر بين التقنية والتعليم لتقديم تجربة مستخدم فريدة تلبي احتياجات الطلاب،
                            المعلمين، المدارس، والعملاء في مكان واحد.
                        </p>
                    </div>

                    <div class="flex justify-center">
                        <img src="{{ asset('images/about.png') }}" alt="About Us" class="w-64">
                    </div>
                </div>
                <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div class="p-6 bg-blue-50 rounded-xl">
                        <div class="text-4xl font-bold text-blue-600 mb-2" x-data="{ count: 0 }"
                            x-init="() => {
                                let start = 0;
                                const end = {{ $users }};
                                const duration = 2000;
                                const step = (end - start) / (duration / 16);
                                const timer = setInterval(() => {
                                    start += step;
                                    if (start >= end) {
                                        clearInterval(timer);
                                        start = end;
                                    }
                                    count = Math.floor(start);
                                }, 16);
                            }" x-text="count.toLocaleString()">{{ $users }}</div>
                        <p class="text-gray-700">طالب مسجل</p>
                    </div>

                    <div class="p-6 bg-red-50 rounded-xl">
                        <div class="text-4xl font-bold text-red-600 mb-2" x-data="{ count: 0 }"
                            x-init="() => {
                                let start = 0;
                                const end = {{ $courses }};
                                const duration = 2000;
                                const step = (end - start) / (duration / 16);
                                const timer = setInterval(() => {
                                    start += step;
                                    if (start >= end) {
                                        clearInterval(timer);
                                        start = end;
                                    }
                                    count = Math.floor(start);
                                }, 16);
                            }" x-text="count.toLocaleString()">{{ $courses }}</div>
                        <p class="text-gray-700">دورة تعليمية</p>
                    </div>

                    <div class="p-6 bg-green-50 rounded-xl">
                        <div class="text-4xl font-bold text-green-600 mb-2" x-data="{ count: 0 }"
                            x-init="() => {
                                let start = 0;
                                const end = {{ $schools }};
                                const duration = 2000;
                                const step = (end - start) / (duration / 16);
                                const timer = setInterval(() => {
                                    start += step;
                                    if (start >= end) {
                                        clearInterval(timer);
                                        start = end;
                                    }
                                    count = Math.floor(start);
                                }, 16);
                            }" x-text="count.toLocaleString()">0</div>
                        <p class="text-gray-700">مدرسة شريكة</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <img src="{{ asset('auth/rendered_page.png') }}" alt="VIEDMA Logo" class="h-24 w-36 mb-4">
                    <p class="text-gray-400">منصة متكاملة للتعليم الإلكتروني، التسوق، وإدارة المدارس</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">روابط سريعة</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">الرئيسية</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">عنّا</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">الدورات</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">المتجر</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">خدماتنا</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">منصة التعليم</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">المتجر الإلكتروني</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">نظام المدارس</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">الاشتراكات</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">اتصل بنا</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt ml-2 text-blue-400"></i>
                            <span class="text-gray-400">الرياض، المملكة العربية السعودية</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone ml-2 text-blue-400"></i>
                            <span class="text-gray-400">+966 12 345 6789</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope ml-2 text-blue-400"></i>
                            <span class="text-gray-400">info@viedma.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400">© 2023 VIEDMA. جميع الحقوق محفوظة</p>
                <div class="flex space-x-4 space-x-reverse mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-facebook-f text-lg"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-twitter text-lg"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-instagram text-lg"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-linkedin-in text-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
