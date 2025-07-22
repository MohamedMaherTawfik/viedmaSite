<x-layout>

    <!-- Sidebar -->
    <x-teacher-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-teacher-header />

            <section class="bg-gray-50 p-6 rounded-lg shadow border">
                <h2 class="text-lg font-bold text-[#79131d] mb-4">متابعة التدريب</h2>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse rounded-lg overflow-hidden text-sm text-center text-gray-800">
                        <thead class="bg-white border border-[#007bff]">
                            <tr class="text-gray-600 font-semibold">
                                <th class="px-4 py-2 border">اسم المعلم</th>
                                <th class="px-4 py-2 border">اسم الدورة</th>
                                <th class="px-4 py-2 border">حاله الدورة</th>
                                <th class="px-4 py-2 border">تاريخ التسجيل</th>
                                <th class="px-4 py-2 border">إجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <!-- Row 1 -->
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-2 border flex items-center gap-2 justify-center">
                                        <img src="https://i.pravatar.cc/40?u=1" alt="teacher"
                                            class="rounded-full w-8 h-8">
                                        <span>{{ $user->name }}</span>
                                    </td>
                                    <td class="px-4 py-2 border">{{ $user->course->title }} </td>
                                    <td class="px-4 py-2 border">{{ $user->course->start_Date }} </td>
                                    <td class="px-4 py-2 border">{{ $user->updated_at }}</td>
                                    <td class="px-4 py-2 border">
                                        <a href="" class="text-[#007bff] hover:underline">👁️</a>
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
