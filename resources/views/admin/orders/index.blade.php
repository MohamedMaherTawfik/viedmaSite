<x-layout :title="__('main.all_orders')">

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

            <h2 class="text-2xl font-bold mb-6">{{ __('main.all_orders') }}</h2>

            <table class="min-w-full bg-white border rounded-lg">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="py-3 px-4 text-center">{{ __('main.id') }}</th>
                        <th class="py-3 px-4 text-center">{{ __('main.customer') }}</th>
                        <th class="py-3 px-4 text-center">{{ __('main.status') }}</th>
                        <th class="py-3 px-4 text-center">{{ __('main.price') }}</th>
                        <th class="py-3 px-4 text-center">{{ __('main.quantity') }}</th>
                        <th class="py-3 px-4 text-center">{{ __('main.order_date') }}</th>
                        <th class="py-3 px-4 text-right">{{ __('main.actions') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($orders as $order)
                        <tr class="border-b">
                            <td class="py-3 px-4 text-center">{{ $order->id }}</td>

                            <td class="py-3 px-4 text-center">
                                {{ $order->user->name ?? __('main.not_available') }}
                            </td>

                            <td class="py-3 px-4 text-center">{{ $order->transaction_status }}</td>

                            <td class="py-3 px-4 text-center">{{ $order->price }}</td>

                            <td class="py-3 px-4 text-center">{{ $order->quantity }}</td>

                            <td class="py-3 px-4 text-center">{{ $order->created_at->format('Y/m/d - H:i') }}</td>

                            <td class="py-3 px-4 text-center flex gap-2">

                                {{-- زرار عرض --}}
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                    {{ __('main.view') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </main>
    </div>

</x-layout>
