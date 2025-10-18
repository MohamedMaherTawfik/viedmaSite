<x-layout title="لوحه تحكم المدرب ">

    <!-- Sidebar -->
    <x-trainer-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-teacher-header />
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

            <h1 class="text-2xl font-bold mb-6">لوحة تحكم المدرب</h1>
            <div class="bg-white rounded-xl shadow p-4">
                <h2 class="text-lg font-semibold mb-4">قائمة الدورات</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-right rtl text-gray-600">
                        <thead class="bg-gray-100 text-gray-700 font-semibold">
                            <tr>
                                <th class="px-4 py-2 text-center">اسم المشروع</th>
                                <th class="px-4 py-2 text-center">الحالة</th>
                                <th class="px-4 py-2 text-center"> اسم المتدرب</th>
                                <th class="px-4 py-2 text-center">تاريخ التقييم</th>
                                {{-- <th class="px-4 py-2 text-center text-center">إجراء</th> --}}
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($reports as $item)
                                <tr>
                                    <td class="px-4 py-3 text-center">
                                        {{ $item->project->title ?? 'لم يتم التقييم بعد' }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span
                                            class="bg-orange-100 text-orange-600 px-3 py-1 text-center rounded-full text-xs">{{ $item->status }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        {{ $item->project->feedback ?? 'لم يتم التقييم بعد' }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        {{ $item->created_at->format('d-m-Y') ?? 'لم يتم التقييم بعد' }}
                                    </td>

                                    {{-- <td class="px-4 py-3 text-center text-center">
                                        <a href=""
                                            class="text-blue-600 hover:underline">
                                            👁️
                                        </a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>


    </div>

</x-layout>
