<x-layout>

    <!-- Sidebar -->
    <x-teacher-sidebar />

    <div class="flex flex-col flex-1">
        <main class="p-6 flex-1">
            <x-teacher-header />
            @if (session('success'))
                <div class="mb-4 text-sm text-green-700 bg-green-100 border border-green-300 rounded px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 text-sm text-red-700 bg-red-100 border border-red-300 rounded px-4 py-3">
                    {{ session('error') }}
                </div>
            @endif


            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">ربط ولي الامر</h2>
                <div class="flex gap-2">
                    <a href="{{ route('school.students', request('slug')) }}"
                        class="border border-gray-500 text-gray-500 px-4 py-2 rounded hover:bg-gray-500 hover:text-white transition">
                        العودة للطلاب
                    </a>
                </div>
            </div>

            <section class="bg-white p-4 rounded shadow mt-6 overflow-visible relative z-[1]">
                <div class="overflow-x-auto overflow-visible relative z-[1]">
                    <table class="min-w-full text-sm text-right border-separate border-spacing-y-2">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 rounded-r-lg">اسم ولي الامر</th>
                                <th class="px-4 py-2 text-center">البريد الالكتروني</th>
                                <th class="px-4 py-2 text-center">رقم الهاتف</th>
                                <th class="pr-8 pl-4 py-2 rounded-l-lg text-center">إجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parents as $parent)
                                <tr class="bg-gray-50 text-gray-800">
                                    <td class="px-4 py-2">{{ $parent->name }}</td>
                                    <td class="px-4 py-2 text-center">{{ $parent->email }}</td>
                                    <td class="px-4 py-2 text-center">{{ $parent->phone }}</td>
                                    <td class="relative text-center">
                                        <form method="POST"
                                            action="{{ route('school.student.linkParent.store', ['slug' => request('slug'), 'name' => request('name'), 'parent' => $parent->name]) }}"
                                            class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="text-white bg-blue-600 my-2 rounded py-2 px-2 hover:bg-blue-800 focus:outline-none">
                                                ربط الطالب
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

</x-layout>
