<x-layout title="لوحه تحكم المعلم ">

    <!-- Sidebar -->
    <x-school-sidebar />

    <div class="flex flex-col flex-1">
        <main class="p-6 flex-1">
            <x-school-header />

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">المعلمين</h2>
                <div class="flex gap-2">
                    <a href="{{ route('teacher.student.excel') }}"
                        class="border border-gray-500 text-gray-500 px-4 py-2 rounded hover:bg-gray-500 hover:text-white transition">
                        رفع ملف Excel
                    </a>
                    <a href="{{ route('teacher.student.create') }}"
                        class="border border-gray-500 text-gray-500 px-4 py-2 rounded hover:bg-gray-500 hover:text-white transition">
                        إضافة طالب
                    </a>
                </div>
            </div>

            <section class="bg-white p-4 rounded shadow mt-6 overflow-visible relative z-[1]">
                <div class="overflow-x-auto overflow-visible relative z-[1]">
                    <table class="min-w-full text-sm text-right border-separate border-spacing-y-2">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 rounded-r-lg">اسم الطالب</th>
                                <th class="px-4 py-2 text-center">الرقم القومي</th>
                                <th class="px-4 py-2 text-center">المرحله</th>
                                <th class="px-4 py-2 text-center">ولي الامر</th>
                                <th class="pr-8 pl-4 py-2 rounded-l-lg text-center">إجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr class="bg-gray-50 text-gray-800"
                                    data-edit-url="{{ route('teacher.student.edit', ['student' => $student]) }}"
                                    data-delete-url="{{ route('teacher.student.delete', ['student' => $student]) }}">
                                    <td class="px-4 py-2 flex items-center gap-2 text-center">
                                        <img src="https://th.bing.com/th/id/R.4b6a7d8dc6ff6bd305a872c783d2f450?rik=IcLvZ3InG%2bn33g&pid=ImgRaw&r=0"
                                            class="w-8 h-8 rounded-full" alt="">
                                        {{ $student->name }}
                                    </td>
                                    <td class="px-4 py-2 text-center">{{ $student->national_id }}</td>
                                    <td class="px-4 py-2 text-center">{{ $student->Academic_stage }}</td>
                                    <td class="px-4 py-2 text-center">
                                        {{ $student->user->phone ?? 'لم يتم الربط بولي امر' }}
                                    </td>
                                    <td class="relative text-center">
                                        <button class="text-gray-600 focus:outline-none dropdown-btn">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

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

                            // Close on click outside
                            document.addEventListener('click', () => {
                                menu.remove();
                            }, {
                                once: true
                            });
                        }

                        document.querySelectorAll('.dropdown-btn').forEach(btn => {
                            btn.addEventListener('click', function(e) {
                                e.stopPropagation();
                                const tr = btn.closest('tr');
                                const rect = btn.getBoundingClientRect();

                                const editUrl = tr.dataset.editUrl;
                                const deleteUrl = tr.dataset.deleteUrl;
                                const showUrl = tr.dataset.showUrl;
                                const linkParentUrl = tr.dataset.linkParentUrl;

                                const html = `
                                    <a href='${editUrl}' class='flex items-center gap-2 px-2 py-1 rounded hover:bg-gray-100'>
                                        <span class='w-6 h-6 flex items-center justify-center border border-blue-500 rounded-full'>
                                            <i class='fas fa-pen text-blue-500 text-xs'></i>
                                        </span>
                                        تعديل
                                    </a>

                                    <a href="${deleteUrl}" onclick="return confirm('هل أنت متأكد من الحذف؟');"
                                    class="flex items-center gap-2 px-2 py-1 rounded hover:bg-gray-100">
                                        <span class="w-6 h-6 flex items-center justify-center border border-red-500 rounded-full">
                                            <i class="fas fa-trash text-red-500 text-xs"></i>
                                        </span>
                                        حذف
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
