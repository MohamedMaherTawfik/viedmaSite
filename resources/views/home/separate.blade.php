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

    <x-video-sction />

    <x-service-section />

    <x-footer />

</body>

</html>
