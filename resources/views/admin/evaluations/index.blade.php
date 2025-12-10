<x-layout title="{{ __('main.trainer_dashboard') }}">

    <x-admin-sidebar />

    <div class="flex flex-col flex-1">

        <main class="p-6 flex-1">
            <x-admin-header />

            {{-- Success Message --}}
            @if (session('success'))
                <div class="p-4 mb-4 text-green-800 bg-green-200 border border-green-300 rounded">
                    {{ __('main.success') }}
                </div>
            @endif

            {{-- Fail Message --}}
            @if (session('fail'))
                <div class="p-4 mb-4 text-red-800 bg-red-200 border border-red-300 rounded">
                    {{ __('main.fail') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="p-4 mb-4 text-red-800 bg-red-100 border border-red-300 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ __('main.validation_errors') }}: {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h1 class="text-2xl font-bold mb-6">{{ __('main.trainer_dashboard') }}</h1>

            <div class="bg-white rounded-xl shadow p-4">
                <h2 class="text-lg font-semibold mb-4">{{ __('main.courses_list') }}</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-right rtl text-gray-600">
                        <thead class="bg-gray-100 text-gray-700 font-semibold">
                            <tr>
                                <th class="px-4 py-2 text-center">{{ __('main.project_name') }}</th>
                                <th class="px-4 py-2 text-center">{{ __('main.status') }}</th>
                                <th class="px-4 py-2 text-center">{{ __('main.trainee_name') }}</th>
                                <th class="px-4 py-2 text-center">{{ __('main.evaluation_date') }}</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @foreach ($reports as $item)
                                <tr>
                                    <td class="px-4 py-3 text-center">
                                        {{ $item->project->title ?? __('main.not_evaluated_yet') }}
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-xs">
                                            {{ $item->status }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        {{ $item->project->feedback ?? __('main.not_evaluated_yet') }}
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        {{ $item->created_at->format('d-m-Y') ?? __('main.not_evaluated_yet') }}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </main>
    </div>

</x-layout>
