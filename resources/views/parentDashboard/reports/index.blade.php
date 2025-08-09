<x-layout title="لوحة تحكم ولي الأمر">

    <!-- Sidebar -->
    <x-parent-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-parent-header />
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

            <div class="overflow-x-auto bg-white rounded shadow mt-6">
                <table class="min-w-full text-sm text-gray-700 text-center">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="py-3 px-4">اسم المعلم</th>
                            <th class="py-3 px-4">اسم الطالب</th>
                            <th class="py-3 px-4">التقييم</th>
                            <th class="py-3 px-4">الملف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4">{{ $item->user->name ?? '-' }}</td>
                                <td class="py-3 px-4">{{ $item->student->name ?? '-' }}</td>
                                <td class="py-3 px-4">{{ $item->report ?? '-' }}</td>
                                <td class="py-3 px-4">
                                    @if ($item->file)
                                        <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                            class="text-blue-600 hover:underline">عرض الملف</a>
                                    @else
                                        <span class="text-gray-400">لا يوجد</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </main>
    </div>

</x-layout>
