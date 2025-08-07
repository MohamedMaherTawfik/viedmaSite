@php
    use App\Models\orderdetails;
    $orderDetails = orderdetails::where('orders_id', $order->id)->pluck('games_id');
    $games = \App\Models\games::whereIn('id', $orderDetails)->get();
@endphp

@endphp

<x-layout title="تفاصيل الطلب">

    <x-parent-sidebar />

    <div class="flex flex-col flex-1 bg-gray-100 min-h-screen">
        <main class="p-6 flex-1">
            <x-parent-header />

            <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
                <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">تفاصيل الطلب</h2>

                <div class="border border-gray-200 p-4 rounded-lg mb-6">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">رقم الطلب:</span>
                        <span class="font-semibold">{{ $order->id }}</span>
                    </div>

                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">اسم اللعبة:</span>
                        <span class="font-semibold">{{ $games->pluck('title')->implode(' -- ') ?? 'غير متوفر' }}</span>
                    </div>

                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">السعر:</span>
                        <span class="font-semibold text-green-600">{{ $order->price }} دينار اردني</span>
                    </div>

                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">تاريخ الإنشاء:</span>
                        <span class="font-semibold">{{ $order->created_at->format('Y-m-d H:i') }}</span>
                    </div>
                </div>
            </div>
        </main>
    </div>

</x-layout>
