<x-layout title="لوحه تحكم المدرسه ">

    <!-- Sidebar -->
    <x-teacher-sidebar />

    <div class="flex flex-col flex-1">
        <main class="p-6 flex-1">
            <x-teacher-header />

            <section class="bg-white p-6 rounded-xl shadow">

                <!-- جدول -->
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-center ltr:text-left rtl:text-right rounded overflow-hidden">
                        <thead class="bg-gray-100 text-gray-700 font-semibold">
                            <tr>
                                <th class="p-3 text-center">اسم المعلم</th>
                                <th class="p-3 text-center">الدورة</th>
                                <th class="p-3 text-center">اسم المشروع</th>
                                <th class="p-3 text-center">الملاحظات</th>
                                <th class="p-3 text-center">الملف</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($graduationProjects as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 text-center flex items-center justify-center gap-2">
                                        <span>{{ $item->teacher->name }} </span>
                                    </td>
                                    <td class="p-3 text-center">{{ $item->course->title }} </td>
                                    <td class="p-3 text-center">{{ $item->title }}</td>

                                    <td class="p-3 text-center text-gray-500">{{ $item->description }}</td>
                                    <td class="p-3 text-center">
                                        <a href="{{ asset('storage/' . $item->file) }}">
                                            <i class="fas fa-link text-indigo-600"></i>
                                        </a>
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
