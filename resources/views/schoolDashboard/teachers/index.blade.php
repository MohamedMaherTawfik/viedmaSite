<x-layout>

    <!-- Sidebar -->
    <x-school-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-school-header />

            <section class="bg-white p-4 rounded shadow mt-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold">المعلمين</h2>
                    <a href="{{ route('school.teachers.create', ['slug' => request('slug')]) }}"
                        class="border border-blue-500 text-blue-500 px-4 py-2 rounded hover:bg-blue-500 hover:text-white transition">
                        إضافة معلم
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-right border-separate border-spacing-y-2">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 rounded-r-lg">الاسم</th>
                                <th class="px-4 py-2">البريد</th>
                                <th class="px-4 py-2">الوصف</th>
                                <th class="px-4 py-2">رقم الجوال</th>
                                <th class="px-4 py-2">الحالة</th>
                                <th class="px-4 py-2">تاريخ التسجيل</th>
                                <th class="pr-8 pl-4 py-2 rounded-l-lg text-center">إجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- صف 1 -->
                            @foreach ($applies as $apply)
                                <tr class="bg-gray-50 text-gray-800">
                                    <td class="px-4 py-2 flex items-center gap-2">
                                        <img src="https://th.bing.com/th/id/R.4b6a7d8dc6ff6bd305a872c783d2f450?rik=IcLvZ3InG%2bn33g&pid=ImgRaw&r=0"
                                            class="w-8 h-8 rounded-full" alt="">
                                        {{ $apply->user->name }}
                                    </td>
                                    <td class="px-4 py-2">{{ $apply->user->email }}</td>
                                    <td class="px-4 py-2">{{ $apply->topic }}</td>
                                    <td class="px-4 py-2">{{ $apply->phone }}</td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">{{ $apply->status }}</span>
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ \Carbon\Carbon::parse($apply->created_at)->format('Y-m-d') }} </td>
                                    <td class="px-4 py-2 flex gap-2 justify-center">
                                        <a href="{{ route('school.teachers.show', ['slug' => request('slug'), 'name' => $apply->user->name]) }}"
                                            class="inline-flex items-center justify-center px-3 py-2 rounded border border-blue-500 bg-blue-100 text-blue-500 hover:bg-blue-200 hover:text-blue-700 transition">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        {{-- <a href="{{ route('school.teachers.edit', ['slug' => request('slug'), 'name' => $apply->user->name]) }}"
                                            class="inline-flex items-center justify-center px-3 py-2 rounded border border-green-500 bg-green-100 text-green-500 hover:bg-green-200 hover:text-green-700 transition">
                                            <i class="fas fa-edit"></i>
                                        </a> --}}

                                        <form
                                            action="{{ route('school.teachers.delete', ['slug' => request('slug'), 'name' => $apply->user->name]) }}"
                                            method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center px-3 py-2 rounded border border-red-500 bg-red-100 text-red-500 hover:bg-red-200 hover:text-red-700 transition">
                                                <i class="fas fa-trash-alt"></i>
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
