<x-home-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">
            {{ Auth::user()->name }} {{ __('messages.cart') }}
        </h1>

        @if ($cartItems && count($cartItems) > 0)
            <div class="grid gap-6 md:grid-cols-3">
                <!-- عناصر السلة -->
                <div class="md:col-span-2 space-y-4">
                    @foreach ($cartItems as $item)
                        <div class="flex flex-col sm:flex-row border rounded-lg p-4 shadow-sm">
                            <!-- صورة اللعبة -->
                            <div class="sm:w-1/5 sm:h-1/5 mb-4 sm:mb-0">
                                <img src="{{ $item->games->cover_image ? asset('storage/' . $item->games->cover_image) : 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=' }}"
                                    alt="{{ $item->games->name }}" class="w-full h-auto object-cover rounded">
                            </div>

                            <!-- تفاصيل اللعبة -->
                            <div class="sm:w-3/4 sm:pl-6">
                                <h2 class="text-xl font-semibold">{{ $item->games->title }}</h2>
                                <p class="text-gray-600 mt-2">{{ $item->games->description }}</p>

                                <div class="mt-4 flex items-center justify-between">
                                    <span class="text-lg font-bold">
                                        ${{ $item->games->price * $item->quantity }}
                                    </span>

                                    <div class="flex items-center gap-4">
                                        <span>{{ __('messages.quantity') }}: {{ $item->quantity }}</span>

                                        <!-- زر الحذف -->
                                        <form action="{{ route('game.removeFromCart', $item->games->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('messages.confirm_delete') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                                                {{ __('messages.delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- ملخص الطلب -->
                <div class="border rounded-lg p-6 h-fit shadow-sm">
                    <h2 class="text-xl font-bold mb-4">{{ __('messages.order_summary') }}</h2>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between font-bold text-lg pt-2 border-t">
                            <span>{{ __('messages.total') }}:</span>
                            <span>${{ $total }}</span>
                        </div>

                        <div class="flex justify-between font-bold text-lg pt-2 border-t">
                            <span>{{ __('messages.number_of_games') }}:</span>
                            <span>{{ $cartCount }} {{ __('messages.games') }}</span>
                        </div>
                    </div>

                    <form action="{{ route('checkout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit"
                            class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-lg font-medium transition duration-200">
                            {{ __('messages.buy_now') }}
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <h2 class="text-2xl font-semibold text-gray-600">
                    {{ __('messages.cart_empty') }}
                </h2>
                <a href="{{ route('home') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                    {{ __('messages.continue_shopping') }}
                </a>
            </div>
        @endif
    </div>
</x-home-layout>
