<x-layout title="{{ __('main.admin_dashboard') }}">

    {{-- sidebar --}}
    <x-admin-sidebar />

    <div class="flex flex-col flex-1">
        <x-messagesdata />

        <main class="p-6 flex-1">
            <x-admin-header />

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ __('main.academic_stages') }}
                </h2>

                <button onclick="openAddModal()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + {{ __('main.add_academic_stage') }}
                </button>
            </div>

            {{-- Table --}}
            <div class="bg-white rounded shadow">
                <table class="w-full text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3">#</th>
                            <th class="p-3">{{ __('main.name') }}</th>
                            <th class="p-3 text-right">{{ __('main.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($academicStages as $stage)
                            <tr class="border-t">
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <td class="p-3">{{ $stage->name }}</td>
                                <td class="p-3 text-right flex justify-end gap-2">

                                    <button onclick="openEditModal({{ $stage->id }}, '{{ $stage->name }}')"
                                        class="px-3 py-1 bg-yellow-500 text-white rounded">
                                        {{ __('main.edit') }}
                                    </button>

                                    <a href="{{ route('admin.academicStage.delete', $stage->id) }}"
                                        onclick="return confirm('{{ __('main.confirm_delete') }}')"
                                        class="px-3 py-1 bg-red-600 text-white rounded">
                                        {{ __('main.delete') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Add Modal --}}
            <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-lg w-full max-w-md p-6">
                    <h3 class="text-lg font-bold mb-4">
                        {{ __('main.add_academic_stage') }}
                    </h3>

                    <form action="{{ route('admin.academicStage.store') }}" method="POST">
                        @csrf

                        <input type="text" name="name" class="w-full border rounded px-3 py-2 mb-4"
                            placeholder="{{ __('main.stage_name') }}" required>

                        <div class="flex justify-end gap-2">
                            <button type="button" onclick="closeAddModal()" class="px-4 py-2 border rounded">
                                {{ __('main.cancel') }}
                            </button>

                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                                {{ __('main.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Edit Modal --}}
            <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-lg w-full max-w-md p-6">
                    <h3 class="text-lg font-bold mb-4">
                        {{ __('main.edit_academic_stage') }}
                    </h3>

                    <form id="editForm" method="POST">
                        @csrf

                        {{-- hidden id --}}
                        <input type="hidden" name="id" id="editId">

                        <input type="text" name="name" id="editName" class="w-full border rounded px-3 py-2 mb-4"
                            required>

                        <div class="flex justify-end gap-2">
                            <button type="button" onclick="closeEditModal()" class="px-4 py-2 border rounded">
                                {{ __('main.cancel') }}
                            </button>

                            <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded">
                                {{ __('main.update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>
</x-layout>
<script>
    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
        document.getElementById('addModal').classList.add('flex');
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
    }

    function openEditModal(id, name) {
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');

        document.getElementById('editId').value = id;
        document.getElementById('editName').value = name;

        // action ثابت
        document.getElementById('editForm').action =
            "{{ route('admin.academicStage.update', ':id') }}".replace(':id', id);
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>
