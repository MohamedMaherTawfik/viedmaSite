<x-layout :title="__('main.admin_order_details')">

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

            <h2 class="text-2xl font-bold mb-6">{{ __('main.order_details_number', ['id' => $order->id]) }}</h2>

            {{-- Order Info --}}
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <h3 class="text-xl font-semibold mb-4">{{ __('main.order_info') }}</h3>

                <div class="grid grid-cols-2 gap-4">
                    <p><strong>{{ __('main.customer') }}:</strong> {{ $order->user->name ?? __('main.not_available') }}</p>
                    <p><strong>{{ __('main.status') }}:</strong> {{ $order->transaction_status }}</p>
                    <p><strong>{{ __('main.total_price') }}:</strong> {{ $order->price }}</p>
                    <p><strong>{{ __('main.total_quantity') }}:</strong> {{ $order->quantity }}</p>
                    <p><strong>{{ __('main.created_at') }}:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                </div>

                {{-- Edit Button --}}
                <button onclick="document.getElementById('editModal').classList.remove('hidden')"
                    class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    {{ __('main.edit_order') }}
                </button>
            </div>

            {{-- Order Products --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-4">{{ __('main.order_products') }}</h3>

                <table class="min-w-full bg-white border rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="py-3 px-4 text-right">{{ __('main.game') }}</th>
                            <th class="py-3 px-4 text-right">{{ __('main.quantity') }}</th>
                            <th class="py-3 px-4 text-right">{{ __('main.price') }}</th>
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

            {{-- Edit Modal --}}
            <div id="editModal"
                class="hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50">
                <div class="bg-white w-1/3 p-6 rounded-lg shadow-lg relative">

                    <h3 class="text-xl font-bold mb-4">{{ __('main.edit_order') }}</h3>

                    {{-- X Close Button --}}
                    <button onclick="document.getElementById('editModal').classList.add('hidden')"
                        class="absolute top-3 left-3 text-gray-600 hover:text-black">
                        ✖
                    </button>

                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">{{ __('main.status') }}</label>
                            <select name="transaction_status" class="w-full border p-2 rounded">
                                <option value="pending" {{ $order->transaction_status == 'pending' ? 'selected' : '' }}>
                                    {{ __('main.pending') }}</option>
                                <option value="completed" {{ $order->transaction_status == 'completed' ? 'selected' : '' }}>
                                    {{ __('main.completed') }}</option>
                                <option value="canceled" {{ $order->transaction_status == 'canceled' ? 'selected' : '' }}>
                                    {{ __('main.canceled') }}</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">{{ __('main.total_price') }}</label>
                            <input type="number" name="price" value="{{ $order->price }}"
                                class="w-full border p-2 rounded">
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">{{ __('main.total_quantity') }}</label>
                            <input type="number" name="quantity" value="{{ $order->quantity }}"
                                class="w-full border p-2 rounded">
                        </div>

                        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            {{ __('main.save_changes') }}
                        </button>
                    </form>
                </div>
            </div>

        </main>
    </div>

</x-layout>
