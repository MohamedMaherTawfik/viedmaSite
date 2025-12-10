<x-layout title="{{ __('main.categories') }}">

    {{-- Sidebar --}}
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

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">{{ __('main.categories') }}</h2>
                <button onclick="openCreateModal()"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    {{ __('main.create_category') }}
                </button>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border-b text-right">#</th>
                            <th class="px-4 py-2 border-b text-right">{{ __('main.name') }}</th>
                            <th class="px-4 py-2 border-b text-right">{{ __('main.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories->sortByDesc('id') as $category)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2 text-gray-700">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $category->name }}</td>
                                <td class="px-4 py-2 flex gap-2">
                                    <button onclick="openEditModal({{ $category->id }}, '{{ $category->name }}')"
                                        class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                        {{ __('main.edit') }}
                                    </button>
                                    <form action="{{ route('admin.courses.category.delete', $category->id) }}"
                                        method="POST" onsubmit="return confirm('{{ __('main.delete_confirm') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                            {{ __('main.delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-4 text-center text-gray-500">{{ __('main.no_categories') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </main>
    </div>

    {{-- 🟢 إنشاء تصنيف جديد --}}
    <div id="createModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">{{ __('main.add_category') }}</h3>
            <form action="{{ route('admin.courses.category.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">{{ __('main.name') }}</label>
                    <input type="text" name="name"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200 outline-none" required>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeCreateModal()"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">{{ __('main.cancel') }}</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">{{ __('main.save') }}</button>
                </div>
            </form>
        </div>
    </div>

    {{-- 🟡 تعديل تصنيف --}}
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">{{ __('main.edit_category') }}</h3>
            <form id="editForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">{{ __('main.name') }}</label>
                    <input type="text" name="name" id="editName"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-yellow-200 outline-none" required>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">{{ __('main.cancel') }}</button>
                    <button type="submit"
                        class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">{{ __('main.update') }}</button>
                </div>
            </form>
        </div>
    </div>

    {{-- JavaScript للتحكم في المودالات --}}
    <script>
        const createModal = document.getElementById('createModal');
        const editModal = document.getElementById('editModal');
        const editForm = document.getElementById('editForm');
        const editName = document.getElementById('editName');

        function openCreateModal() {
            createModal.classList.remove('hidden');
            createModal.classList.add('flex');
        }

        function closeCreateModal() {
            createModal.classList.add('hidden');
        }

        function openEditModal(id, name) {
            editModal.classList.remove('hidden');
            editModal.classList.add('flex');
            editName.value = name;
            editForm.action = `/admin/courses/category/${id}`;
        }

        function closeEditModal() {
            editModal.classList.add('hidden');
        }
    </script>

</x-layout>
