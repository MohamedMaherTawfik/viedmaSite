<x-layout>

    <!-- Sidebar -->
    <x-trainer-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-teacher-header />

            <h1 class="text-2xl font-bold mb-6">لوحة تحكم المدرب</h1>

            <!-- Table Container -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">المتدرب</th>
                            <th scope="col" class="px-6 py-3">الدورة</th>
                            <th scope="col" class="px-6 py-3">المشروع</th>
                            <th scope="col" class="px-6 py-3">تاريخ الرفع</th>
                            <th scope="col" class="px-6 py-3">الحالة</th>
                            <th scope="col" class="px-6 py-3">الملف</th>
                            <th scope="col" class="px-6 py-3">الإجراء</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                        <!-- Row 1 -->
                        @foreach ($assignments as $item)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-6 py-4">{{ $item->user->name }}</td>
                                <td class="px-6 py-4">{{ $item->graduationProject->course()->title }}</td>
                                <td class="px-6 py-4">{{ $item->graduationProject->title }} </td>
                                <td class="px-6 py-4">{{ $item->created_at }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $item->graduationNotes->status }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a2.25 2.25 0 00-2.25-2.25H9m0 0V5.625c0-1.4 1.525-2.25 2.924-2.25H19.5" />
                                    </svg>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="" class="text-yellow-500 hover:text-yellow-700">تقييم</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </main>

    </div>

</x-layout>
