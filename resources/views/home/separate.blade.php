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
            background: #176b98;
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
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
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
            border-right: .15em solid #176b98;
            white-space: nowrap;
            animation: typing 3.5s steps(40, end),
                blink-caret .75s step-end infinite;
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
                border-color: #176b98;
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
            background-color: #176b98;
            background-image: radial-gradient(at 47% 33%, #FEBE35 0, transparent 59%),
                radial-gradient(at 82% 65%, #F04A22 0, transparent 55%);
        }
    </style>
</head>

<body class="min-h-screen flex flex-col" x-data="{
    activeSection: 'home',
    init() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.fade-in').forEach((element) => observer.observe(element));
    }
}">

    <x-navbar />

    <!-- Hero Section -->
    <section x-show="activeSection === 'home'" class="text-white py-20" style="background-color: #176b98;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0 fade-in">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 typewriter">مرحباً بكم في VIEDMA</h1>
                    <p class="text-xl mb-8">منصة متكاملة تجمع بين التعليم الإلكتروني، التسوق، وإدارة المدارس في مكان
                        واحد</p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('schools') }}"
                            class="bg-white text-[#176b98] px-6 py-3 rounded-lg font-bold shadow-lg hover:bg-gray-100 transition duration-300">
                            ابدأ الرحلة التعليمية
                        </a>
                        <a href="{{ route('home') }}"
                            class="border-2 border-white text-white px-6 py-3 rounded-lg font-bold hover:bg-white hover:text-[#176b98] transition duration-300">
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
            <h2 class="text-3xl font-bold text-center mb-12 text-[#374151]">خدماتنا</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Education Card -->
                <div class="bg-gradient-to-br from-[#176b9820] to-[#176b9830] rounded-2xl shadow-lg card-hover fade-in">
                    <div class="p-6">
                        <div class="flex justify-center mb-6">
                            <div
                                class="w-20 h-20 rounded-full bg-[#176b98] flex items-center justify-center text-white text-3xl">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-center mb-4 text-[#374151]">الذهاب إلى المدارس</h3>
                        <p class="text-[#374151b3] text-center mb-6">
                            تعرّف على المدارس المتاحة بالقرب منك، واستكشف تفاصيلها لتحديد الأنسب لرحلتك التعليمية.
                        </p>

                        <a href="{{ route('schools') }}"
                            class="block text-center bg-[#176b98] text-white py-2 px-4 rounded-lg font-semibold hover:bg-[#145a7e] transition duration-300">
                            ابدأ التعلم الآن
                        </a>
                    </div>
                </div>

                <!-- E-commerce Card -->
                <div class="bg-gradient-to-br from-[#FEBE3530] to-[#F04A2220] rounded-2xl shadow-lg card-hover fade-in">
                    <div class="p-6">
                        <div class="flex justify-center mb-6">
                            <div
                                class="w-20 h-20 rounded-full bg-[#F04A22] flex items-center justify-center text-white text-3xl">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-center mb-4 text-[#374151]">متجر إلكتروني</h3>
                        <p class="text-[#374151b3] text-center mb-6">
                            تسوق أحدث المنتجات والمواد التعليمية بأسعار تنافسية وتوصيل سريع
                        </p>
                        <a href="{{ route('home') }}"
                            class="block text-center bg-[#F04A22] text-white py-2 px-4 rounded-lg font-semibold hover:bg-[#d23d1a] transition duration-300">
                            تصفح المتجر
                        </a>
                    </div>
                </div>

                <!-- Schools Card -->
                <div class="bg-gradient-to-br from-[#FEBE3530] to-[#176b9820] rounded-2xl shadow-lg card-hover fade-in">
                    <div class="p-6">
                        <div class="flex justify-center mb-6">
                            <div
                                class="w-20 h-20 rounded-full bg-[#FEBE35] flex items-center justify-center text-white text-3xl">
                                <i class="fas fa-school"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-center mb-4 text-[#374151]">تعليم و تطوير مدرسين</h3>
                        <p class="text-[#374151b3] text-center mb-6">
                            نوفر برامج تدريبية متخصصة باستخدام أحدث أساليب التدريس والتكنولوجيا في العملية التعليمية.
                        </p>

                        <a href="{{ route('web.courses') }}"
                            class="block text-center bg-[#FEBE35] text-white py-2 px-4 rounded-lg font-semibold hover:bg-[#e1a82f] transition duration-300">
                            اكتشف المزيد
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#374151] text-white py-12 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <img src="{{ asset('auth/rendered_page.png') }}" alt="VIEDMA Logo" class="h-24 w-36 mb-4">
                    <p class="text-gray-300">منصة متكاملة للتعليم الإلكتروني، التسوق، وإدارة المدارس</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4 text-[#FEBE35]">روابط سريعة</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition">الرئيسية</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">عنّا</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">الدورات</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">المتجر</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4 text-[#FEBE35]">خدماتنا</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition">منصة التعليم</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">المتجر الإلكتروني</a>
                        </li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">نظام المدارس</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">الاشتراكات</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4 text-[#FEBE35]">اتصل بنا</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt ml-2 text-[#FEBE35]"></i>
                            <span class="text-gray-300">الرياض، المملكة العربية السعودية</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone ml-2 text-[#FEBE35]"></i>
                            <span class="text-gray-300">+966 12 345 6789</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope ml-2 text-[#FEBE35]"></i>
                            <span class="text-gray-300">info@viedma.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-600 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-300">© 2025 VIEDMA. جميع الحقوق محفوظة</p>
                <div class="flex space-x-4 space-x-reverse mt-4 md:mt-0">
                    <a href="#" class="text-gray-300 hover:text-[#FEBE35] transition">
                        <i class="fab fa-facebook-f text-lg"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-[#FEBE35] transition">
                        <i class="fab fa-twitter text-lg"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-[#FEBE35] transition">
                        <i class="fab fa-instagram text-lg"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-[#FEBE35] transition">
                        <i class="fab fa-linkedin-in text-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
