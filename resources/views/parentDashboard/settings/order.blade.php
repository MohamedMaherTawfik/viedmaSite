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
            {{-- Success Message --}}
            @if (session('success'))
                <div class="p-4 mb-4 text-green-800 bg-green-200 border border-green-300 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Fail Message --}}
            @if (session('fail'))
                <div class="p-4 mb-4 text-red-800 bg-red-200 border border-red-300 rounded">
                    {{ session('fail') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="p-4 mb-4 text-red-800 bg-red-100 border border-red-300 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
