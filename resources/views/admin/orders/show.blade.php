<x-layout title="لوحة تحكم الادمن">

    {{-- sidebar --}}
    <x-admin-sidebar />

    <div class="flex flex-col flex-1">
        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Message --}}
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-admin-header />

            <h2 class="text-2xl font-bold mb-6">تفاصيل الطلب رقم {{ $order->id }}</h2>

            {{-- بيانات الطلب --}}
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <h3 class="text-xl font-semibold mb-4">بيانات الطلب</h3>

                <div class="grid grid-cols-2 gap-4">
                    <p><strong>العميل:</strong> {{ $order->user->name ?? 'غير متوفر' }}</p>
                    <p><strong>الحالة:</strong> {{ $order->transaction_status }}</p>
                    <p><strong>السعر الكلي:</strong> {{ $order->price }}</p>
                    <p><strong>الكمية الكلية:</strong> {{ $order->quantity }}</p>
                    <p><strong>تاريخ الإنشاء:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                </div>

                {{-- زر تعديل --}}
                <button onclick="document.getElementById('editModal').classList.remove('hidden')"
                    class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    تعديل الطلب
                </button>
            </div>

            {{-- تفاصيل الطلب --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-4">تفاصيل المنتجات</h3>

                <table class="min-w-full bg-white border rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="py-3 px-4 text-right">اللعبة</th>
                            <th class="py-3 px-4 text-right">الكمية</th>
                            <th class="py-3 px-4 text-right">السعر</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orderdetails as $item)
                            <tr class="border-b">
                                <td class="py-3 px-4">{{ $item->game->title }}</td>
                                <td class="py-3 px-4">{{ $item->quantity }}</td>
                                <td class="py-3 px-4">{{ $item->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- =======================
       EDIT MODAL
======================= --}}
            <div id="editModal"
                class="hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50">
                <div class="bg-white w-1/3 p-6 rounded-lg shadow-lg relative">

                    <h3 class="text-xl font-bold mb-4">تعديل الطلب</h3>

                    {{-- X Close Button --}}
                    <button onclick="document.getElementById('editModal').classList.add('hidden')"
                        class="absolute top-3 left-3 text-gray-600 hover:text-black">
                        ✖
                    </button>

                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">الحالة</label>
                            <select name="transaction_status" class="w-full border p-2 rounded">
                                <option value="pending"
                                    {{ $order->transaction_status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="completed"
                                    {{ $order->transaction_status == 'completed' ? 'selected' : '' }}>
                                    Completed</option>
                                <option value="canceled"
                                    {{ $order->transaction_status == 'canceled' ? 'selected' : '' }}>Canceled
                                </option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">السعر الكلي</label>
                            <input type="number" name="price" value="{{ $order->price }}"
                                class="w-full border p-2 rounded">
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">الكمية الكلية</label>
                            <input type="number" name="quantity" value="{{ $order->quantity }}"
                                class="w-full border p-2 rounded">
                        </div>

                        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            حفظ التعديلات
                        </button>
                    </form>
                </div>
            </div>



        </main>


    </div>

</x-layout>
