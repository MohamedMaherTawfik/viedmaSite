<x-layout title="لوحة تحكم ولي الأمر">

    <!-- Sidebar -->
    <x-parent-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">
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

        <!-- Main Content -->
        <main class="p-6 flex-1 space-y-6">
            <x-parent-header />

            <h1 class="text-2xl font-bold mb-4">سلة المشتريات</h1>

            @if (session('success'))
                <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 border border-green-300 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Cart Items Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($cartItems as $item)
                    <div class="border rounded-lg shadow-lg overflow-hidden bg-white flex flex-col">
                        <!-- صورة اللعبة -->
                        <img src="{{ $item->games->image ?? asset('images/default-game.png') }}" alt="صورة اللعبة"
                            class="h-48 w-full object-cover">

                        <!-- تفاصيل اللعبة -->
                        <div class="p-4 flex flex-col justify-between flex-1">
                            <div>
                                <h2 class="text-lg font-semibold mb-2">
                                    {{ $item->games->title ?? 'اسم اللعبة غير متوفر' }}
                                </h2>

                                <span class="text-blue-600 font-bold block mb-2">
                                    {{ ($item->games->price ?? 0) * $item->quantity }} دينار
                                </span>
                            </div>

                            <!-- الكمية وزر الحذف -->
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-sm text-gray-700">الكمية: {{ $item->quantity }}</span>

                                <form action="{{ route('parent.game.removeFromCart', $item) }}" method="POST"
                                    onsubmit="return confirm('هل أنت متأكد من حذف هذه اللعبة من السلة؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 text-sm rounded transition">
                                        حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 col-span-full text-center">لا توجد عناصر في السلة.</p>
                @endforelse
            </div>



            <!-- Checkout Button -->
            @if ($cartItems->count())
                <div x-data="{ showModal: false }" class="flex justify-end mt-6">
                    <!-- زر فتح المودال -->
                    <button @click="showModal = true"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded shadow">
                        إتمام الشراء
                    </button>

                    <!-- المودال -->
                    <div x-show="showModal" x-cloak
                        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" x-transition>
                        <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6" @click.away="showModal = false">
                            <h2 class="text-xl font-bold mb-4 text-gray-800">تأكيد العملية</h2>
                            <p class="text-gray-600 mb-6">هل أنت متأكد أنك تريد إتمام عملية الشراء؟</p>

                            <div class="flex justify-end gap-4">
                                <!-- زر إلغاء -->
                                <button @click="showModal = false"
                                    class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold">
                                    إلغاء
                                </button>

                                <!-- زر التأكيد -->
                                <form method="POST" action="{{ route('checkout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-2 rounded bg-green-600 hover:bg-green-700 text-white font-semibold">
                                        تأكيد الشراء
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </main>

    </div>

</x-layout>
