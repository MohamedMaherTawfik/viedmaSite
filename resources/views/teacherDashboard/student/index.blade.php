<x-layout title="{{ __('main.teacher_dashboard') }}">

    <!-- Sidebar -->
    <x-trainer-sidebar />

    <div class="flex flex-col flex-1">
        <main class="p-6 flex-1">
            <x-teacher-header />

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

            {{-- Header --}}
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">{{ __('main.students') }}</h2>

                <div class="flex gap-2 items-center">
                    {{-- Filter --}}
                    <select id="stageFilter"
                        class="border border-gray-400 px-3 py-2 rounded text-sm focus:outline-none">
                        <option value="all">{{ __('main.all_stages') }}</option>
                        @foreach ($academicStages as $stage)
                            <option value="{{ $stage->name }}">{{ $stage->name }}</option>
                        @endforeach
                    </select>

                    <a href="{{ route('teacher.student.excel') }}"
                        class="border border-gray-500 text-gray-500 px-4 py-2 rounded hover:bg-gray-500 hover:text-white transition">
                        {{ __('main.upload_excel') }}
                    </a>

                    <a href="{{ route('teacher.student.create') }}"
                        class="border border-gray-500 text-gray-500 px-4 py-2 rounded hover:bg-gray-500 hover:text-white transition">
                        {{ __('main.add_student') }}
                    </a>
                </div>
            </div>

            {{-- Table --}}
            <section class="bg-white p-4 rounded shadow mt-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-right border-separate border-spacing-y-2">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-center">{{ __('main.student_name') }}</th>
                                <th class="px-4 py-2 text-center">{{ __('main.national_id') }}</th>
                                <th class="px-4 py-2 text-center">{{ __('main.academic_stage') }}</th>
                                <th class="px-4 py-2 text-center">{{ __('main.parent') }}</th>
                                <th class="px-4 py-2 text-center">{{ __('main.actions') }}</th>
                            </tr>
                        </thead>

                        <tbody id="studentsTable">
                            @foreach ($students as $student)
                                <tr class="bg-gray-50 student-row"
                                    data-stage="{{ $student->academicStage->name ?? '' }}"
                                    data-show-url="{{ route('teacher.student.show', $student) }}"
                                    data-edit-url="{{ route('teacher.student.edit', $student) }}"
                                    data-delete-url="{{ route('teacher.student.delete', $student) }}"
                                    data-link-parent-url="{{ route('trainer.student.linkParent', ['name' => $student]) }}">

                                    <td class="px-4 py-3 text-center font-medium">
                                        {{ $student->name }}
                                    </td>

                                    <td class="px-4 py-2 text-center">
                                        {{ $student->national_id }}
                                    </td>

                                    <td class="px-4 py-2 text-center">
                                        {{ $student->academicStage->name ?? __('main.not_defined') }}
                                    </td>

                                    <td class="px-4 py-2 text-center">
                                        {{ $student->user->phone ?? __('main.no_parent') }}
                                    </td>

                                    <td class="text-center relative">
                                        <button type="button" class="dropdown-btn text-gray-600">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </section>
        </main>
    </div>

    {{-- JS --}}
    <script>
        /* Live Stage Filter */
        document.getElementById('stageFilter').addEventListener('change', function() {
            const value = this.value;
            document.querySelectorAll('.student-row').forEach(row => {
                row.style.display =
                    value === 'all' || row.dataset.stage === value ?
                    '' :
                    'none';
            });
        });

        /* Dropdown */
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

            document.addEventListener('click', () => menu.remove(), {
                once: true
            });
        }

        document.querySelectorAll('.dropdown-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const tr = btn.closest('tr');
                const rect = btn.getBoundingClientRect();

                const html = `
                    <a href="${tr.dataset.showUrl}"
                    class="flex items-center gap-2 px-2 py-1 hover:bg-gray-100 rounded">
                        <i class="fas fa-eye text-blue-600"></i>
                        <span>{{ __('main.show') }}</span>
                    </a>

                    <a href="${tr.dataset.editUrl}"
                    class="flex items-center gap-2 px-2 py-1 hover:bg-gray-100 rounded">
                        <i class="fas fa-edit text-yellow-600"></i>
                        <span>{{ __('main.edit') }}</span>
                    </a>

                    <a href="${tr.dataset.linkParentUrl}"
                    class="flex items-center gap-2 px-2 py-1 hover:bg-gray-100 rounded">
                        <i class="fas fa-link text-green-600"></i>
                        <span>{{ __('main.link_parent') }}</span>
                    </a>

                    <a href="${tr.dataset.deleteUrl}"
                    onclick="return confirm('{{ __('main.confirm_delete') }}')"
                    class="flex items-center gap-2 px-2 py-1 hover:bg-gray-100 rounded text-red-600">
                        <i class="fas fa-trash"></i>
                        <span>{{ __('main.delete') }}</span>
                    </a>
                        `;


                showDropdownMenu(html, rect.bottom + window.scrollY, rect.left + window.scrollX);
            });
        });
    </script>

</x-layout>
