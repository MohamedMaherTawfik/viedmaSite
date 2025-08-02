<x-layout title="لوحه تحكم المدرب ">

    <!-- Sidebar -->
    <x-trainer-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-teacher-header />

            <h1 class="text-2xl font-bold mb-6">لوحة تحكم المدرب</h1>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">المعلمين</h2>
                <a href="{{ route('trainer.schedules.create') }}"
                    class="border border-blue-500 text-blue-500 px-4 py-2 rounded hover:bg-blue-500 hover:text-white transition">
                    إضافة موعد تدريب جديد
                </a>
            </div>
            <!-- Table Container -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="px-4 py-3 border-b border-gray-200">الدورة</th>
                            <th class="px-4 py-3 border-b border-gray-200">التاريخ</th>
                            <th class="px-4 py-3 border-b border-gray-200">الوقت</th>
                            <th class="px-4 py-3 border-b border-gray-200">المكان</th>
                            <th class="px-4 py-3 border-b border-gray-200">المحتوى</th>
                            <th class="px-4 py-3 border-b border-gray-200">الأجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Sample Row 2 -->
                        @foreach ($sessionTimes as $item)
                            <tr>
                                <td class="px-4 py-3">{{ $item->courses->title }} </td>
                                <td class="px-4 py-3">{{ $item->courses->start_Date }}</td>
                                <td class="px-4 py-3">{{ $item->date }} - {{ $item->time }}</td>
                                <td class="px-4 py-3"><a href="https://zoom.us/your-meeting-link" target="_blank"
                                        class="text-blue-600 hover:underline">
                                        <i class="fas fa-link"></i> Zoom Link
                                    </a>
                                </td>
                                <td class="px-4 py-3">
                                    {{ \Illuminate\Support\Str::limit($item->courses->description, 10) }}
                                </td>
                                <td class="px-4 py-3 flex justify-start flex-row-reverse space-x-2 space-x-reverse">
                                    <form action="{{ route('trainer.schedules.destroy', $item) }}" method="POST"
                                        onsubmit="return confirm('هل أنت متأكد من الحذف؟');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>

                                    <p></p>
                                    <p></p>
                                    <p></p>
                                    <a href="{{ route('trainer.schedules.edit', $item) }}"
                                        class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>

    </div>

</x-layout>
