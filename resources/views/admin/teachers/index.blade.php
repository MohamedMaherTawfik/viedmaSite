<x-layout title="{{ __('main.admin_dashboard') }}">

    <!-- Sidebar -->
    <x-admin-sidebar />

    <div class="flex flex-col flex-1">
        <main class="p-6 flex-1">
            <x-admin-header />

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

           <div class="flex items-center justify-between mb-4">
    <h2 class="text-lg font-semibold">{{ __('main.all_teachers') }}</h2>
    <div class="flex gap-2">
        <a href="{{ route('admin.teacher.create') }}"
           class="border border-gray-500 text-gray-500 px-4 py-2 rounded hover:bg-gray-500 hover:text-white transition">
            {{ __('main.add_teacher') }}
        </a>
    </div>
</div>

<section class="bg-white p-4 rounded shadow mt-6 overflow-visible relative z-[1]">
    <div class="overflow-x-auto overflow-visible relative z-[1]">
        <table class="min-w-full text-sm text-right border-separate border-spacing-y-2">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 rounded-r-lg">{{ __('main.name') }}</th>
                    <th class="px-4 py-2 text-center">{{ __('main.email') }}</th>
                    <th class="px-4 py-2 text-center">{{ __('main.school') }}</th>
                    <th class="px-4 py-2 text-center">{{ __('main.phone') }}</th>
                    <th class="pr-8 pl-4 py-2 text-center rounded-l-lg">{{ __('main.actions') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($students as $teacher)
                    <tr class="bg-gray-50 text-gray-800"
                        data-edit-url="{{ route('admin.teacher.edit', ['teacher' => $teacher]) }}"
                        data-delete-url="{{ route('admin.teacher.delete', ['teacher' => $teacher]) }}">

                        <td class="px-4 py-2 flex items-center gap-2 text-center">
                            <img src="https://th.bing.com/th/id/R.4b6a7d8dc6ff6bd305a872c783d2f450?rik=IcLvZ3InG%2bn33g&pid=ImgRaw&r=0"
                                 class="w-8 h-8 rounded-full" alt="{{ __('main.avatar') }}">
                            {{ $teacher->name ?? __('main.no_name') }}
                        </td>

                        <td class="text-center">{{ $teacher->email ?? __('main.no_email') }}</td>
                        <td class="text-center">{{ $teacher->school->name ?? __('main.no_school') }}</td>
                        <td class="text-center">{{ $teacher->phone ?? __('main.no_phone') }}</td>

                        <td class="relative text-center">
                            <button class="text-gray-600 focus:outline-none dropdown-btn">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Dropdown Script -->
        <script>
            function showDropdownMenu(html, top, left) {
                const existing = document.getElementById('dropdown-menu');
                if (existing) existing.remove();

                const menu = document.createElement('div');
                menu.id = 'dropdown-menu';
                menu.className = 'absolute bg-white shadow rounded border p-2 space-y-2 z-50';
                menu.style.top = `${top}px`;
                menu.style.left = `${left}px`;
                menu.innerHTML = html;

                document.body.appendChild(menu);

                document.addEventListener('click', () => menu.remove(), { once: true });
            }

            document.querySelectorAll('.dropdown-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const tr = btn.closest('tr');
                    const rect = btn.getBoundingClientRect();

                    const editUrl = tr.dataset.editUrl;
                    const deleteUrl = tr.dataset.deleteUrl;

                    const html = `
                        <a href='${editUrl}' class='flex items-center gap-2 px-2 py-1 rounded hover:bg-gray-100'>
                            <span class='w-6 h-6 flex items-center justify-center border border-blue-500 rounded-full'>
                                <i class='fas fa-pen text-blue-500 text-xs'></i>
                            </span>
                            {{ __('main.edit') }}
                        </a>

                        <a href="${deleteUrl}" onclick="return confirm('{{ __('main.confirm_delete') }}');"
                           class='flex items-center gap-2 px-2 py-1 rounded hover:bg-gray-100'>
                            <span class='w-6 h-6 flex items-center justify-center border border-red-500 rounded-full'>
                                <i class='fas fa-trash text-red-500 text-xs'></i>
                            </span>
                            {{ __('main.delete') }}
                        </a>
                    `;

                    showDropdownMenu(html, rect.top + window.scrollY + 30, rect.left + window.scrollX);
                });
            });
        </script>
    </div>
</section>


        </main>
    </div>

</x-layout>
