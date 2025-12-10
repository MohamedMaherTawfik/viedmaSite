<x-layout title="{{ __('main.admin_dashboard') }}">

    {{-- sidebar --}}
    <x-admin-sidebar />

   <div class="flex flex-col flex-1">

    {{-- Success Message --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ __('main.success_message') }}
        </div>
    @endif

    {{-- Error Message --}}
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ __('main.error_message') }}
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

        <!-- زر إنشاء حساب مدرسة -->
        <div class="mt-4 mb-6">
            <a href="{{ route('admin.schools.create') }}"
                class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                {{ __('main.create_school_account') }}
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-xl p-6 mt-6">
            <h2 class="text-2xl font-bold mb-4">{{ __('main.school_list') }}</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border text-center">{{ __('main.name') }}</th>
                            <th class="px-4 py-2 border text-center">{{ __('main.email') }}</th>
                            <th class="px-4 py-2 border text-center">{{ __('main.manager') }}</th>
                            <th class="px-4 py-2 border text-center">{{ __('main.address') }}</th>
                            <th class="px-4 py-2 border text-center">{{ __('main.city') }}</th>
                            <th class="px-4 py-2 border text-center">{{ __('main.license_number') }}</th>
                            <th class="px-4 py-2 border text-center">{{ __('main.type') }}</th>
                            <th class="px-4 py-2 border text-center">{{ __('main.logo') }}</th>
                            <th class="px-4 py-2 border text-center">{{ __('main.actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($schools as $school)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border text-center">{{ $school->name }}</td>
                                <td class="px-4 py-2 border text-center">{{ $school->admin?->email ?? __('main.no_admin') }}</td>
                                <td class="px-4 py-2 border text-center">{{ $school->admin?->name ?? __('main.no_admin') }}</td>
                                <td class="px-4 py-2 border text-center">{{ $school->address ?? __('main.no_address') }}</td>
                                <td class="px-4 py-2 border text-center">{{ $school->city ?? __('main.no_city') }}</td>
                                <td class="px-4 py-2 border text-center">{{ $school->License_number ?? __('main.no_license') }}</td>
                                <td class="px-4 py-2 border text-center">{{ $school->type ?? __('main.no_type') }}</td>

                                <td class="px-4 py-2 border text-center">
                                    @if ($school->school_logo)
                                        <img src="{{ asset('storage/' . $school->school_logo) }}"
                                             class="w-20 h-20 object-cover rounded-full mx-auto shadow-sm border border-gray-200"
                                             alt="{{ __('main.school_logo') }}">
                                    @else
                                        <img src="{{ asset('auth/rendered_page.png') }}"
                                             class="w-20 h-20 object-cover rounded-full mx-auto shadow-sm border border-gray-200"
                                             alt="{{ __('main.default_image') }}">
                                    @endif
                                </td>

                                <td class="px-4 py-2 text-center flex items-center justify-center gap-3">

                                    {{-- Show --}}
                                    <a href="{{ route('admin.schools.show', $school) }}"
                                        class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-eye text-lg"></i>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.schools.edit', $school) }}"
                                        class="text-green-500 hover:text-green-700">
                                        <i class="fas fa-edit text-lg"></i>
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('admin.schools.destroy', $school) }}" method="POST"
                                        onsubmit="return confirm('{{ __('main.confirm_delete') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash text-lg"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="9" class="px-4 py-3 text-center text-gray-500">
                                    {{ __('main.no_schools') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </main>
</div>


</x-layout>
