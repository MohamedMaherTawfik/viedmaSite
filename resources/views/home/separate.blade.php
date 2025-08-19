<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIEDMA - اختر نوع المستخدم</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        .school-icon {
            background-color: #3B82F6;
            color: white;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .store-icon {
            background-color: #EF4444;
            color: white;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <!-- Logo -->
    <div class="text-center mt-8 mb-8">
        <img src="{{ asset('auth/rendered_page.png') }}" alt="VIEDMA Logo" class="mx-auto mb-4 w-80">
        <h1 class="text-3xl font-bold text-blue-700">اختر وجهتك الي موقعنا</h1>
    </div>

    {{-- cards --}}
    <div class="container mx-auto px-4 pb-8 flex justify-center items-start min-h-[60vh]">
        <!-- User Type Selection Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-5xl mx-auto">
            <!-- School Card -->
            <a href="{{ route('different') }}"
                class="bg-white rounded-2xl shadow-lg w-80 h-64 p-10 flex flex-col justify-center items-center text-center transform transition duration-300 hover:scale-105 cursor-pointer">
                <div class="flex justify-center mb-6">
                    <div class="school-icon w-20 h-20 text-4xl">
                        <i class="fas fa-school"></i>
                    </div>
                </div>
                <p class="font-bold text-2xl text-gray-800">مدرسة</p>
            </a>

            <!-- Store Card -->
            <a href="{{ route('home') }}"
                class="bg-white rounded-2xl shadow-lg w-80 h-64 p-10 flex flex-col justify-center items-center text-center transform transition duration-300 hover:scale-105 cursor-pointer">
                <div class="flex justify-center mb-6">
                    <div class="store-icon w-20 h-20 text-4xl">
                        <i class="fas fa-store"></i>
                    </div>
                </div>
                <p class="font-bold text-2xl text-gray-800">متجر</p>
            </a>
        </div>


    </div>

    <script>
        function selectUser(type) {
            alert(`تم اختيار: ${type}`);
            // يمكنك إضافة تحويل للصفحة التالية هنا
        }
    </script>
</body>

</html>
