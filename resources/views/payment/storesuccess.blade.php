<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>تم الدفع</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-md text-center w-full max-w-md">
        <h1 class="text-3xl font-bold text-green-600">✅ تم الدفع بنجاح!</h1>
        <p class="mt-4 text-gray-700">شكرًا لك، تمت عملية الدفع وتأكيد الطلب.</p>

        <!-- تفاصيل الأوردر -->
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mt-6 text-right">
            <p class="text-gray-700"><span class="font-bold text-green-700">رقم الطلب:</span> {{ $order->id }}</p>
            <p class="text-gray-700"><span class="font-bold text-green-700">عدد العناصر:</span> {{ $order->quantity }}
            </p>
            <p class="text-gray-700"><span class="font-bold text-green-700">المبلغ:</span> {{ $order->price }}
                {{ config('services.clickpay.currency') }}</p>
        </div>

        <!-- زر العودة -->
        <a href="/" class="inline-block mt-6 text-blue-600 font-semibold hover:underline">
            ⬅ العودة للرئيسية
        </a>
    </div>
</body>

</html>
