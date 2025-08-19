<x-home-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">{{ Auth::user()->name }} Cart</h1>

        @if ($cartItems && count($cartItems) > 0)
            <div class="grid gap-6 md:grid-cols-3">
                <!-- Cart Items -->
                <div class="md:col-span-2 space-y-4">
                    @foreach ($cartItems as $item)
                        <div class="flex flex-col sm:flex-row border rounded-lg p-4 shadow-sm">
                            <!-- games Image -->
                            <div class="sm:w-1/4 mb-4 sm:mb-0">
                                <img src="{{ asset('storage/' . $item->games->cover_image) }}"
                                    alt="{{ $item->games->name }}" class="w-full h-auto object-cover rounded">
                            </div>

                            <!-- games Info -->
                            <div class="sm:w-3/4 sm:pl-6">
                                <h2 class="text-xl font-semibold">{{ $item->games->name }}</h2>
                                <p class="text-gray-600 mt-2">{{ $item->games->description }}</p>

                                <div class="mt-4 flex items-center justify-between">
                                    <span class="text-lg font-bold">${{ $item->games->price * $item->quantity }}</span>

                                    <div class="flex items-center gap-4">
                                        <span>Quantity: {{ $item->quantity }}</span>

                                        <!-- زرار حذف -->
                                        <form action="{{ route('game.removeFromCart', $item->games->id) }}"
                                            method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                                                حذف
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


                <!-- Checkout Summary -->
                <div class="border rounded-lg p-6 h-fit shadow-sm">
                    <h2 class="text-xl font-bold mb-4">Order Summary</h2>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between font-bold text-lg pt-2 border-t">
                            <span>Total:</span>
                            <span>${{ $total }}</span>
                        </div>

                        <div class="flex justify-between font-bold text-lg pt-2 border-t">
                            <span>Number of games:</span>
                            <span>{{ $cartCount }} games</span>
                        </div>
                    </div>

                    <form action="{{ route('checkout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit"
                            class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-lg font-medium transition duration-200">
                            شراء الآن
                        </button>
                    </form>

                </div>
            </div>
        @else
            <div class="text-center py-12">
                <h2 class="text-2xl font-semibold text-gray-600">Your cart is empty</h2>
                <a href="{{ route('home') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                    Continue Shopping
                </a>
            </div>
        @endif
    </div>
</x-home-layout>
