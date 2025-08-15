<x-layout title="لوحة تحكم الادمن">

    {{-- sidebar --}}
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

            <div class="overflow-x-auto bg-white rounded-lg shadow p-4">
                <table class="min-w-full border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="px-4 py-2 text-center">اسم المدرسة</th>
                            <th class="px-4 py-2 text-center">اسم المستخدم</th>
                            <th class="px-4 py-2 text-center">الدور</th>
                            <th class="px-4 py-2 text-center">البريد الإلكتروني</th>
                            <th class="px-4 py-2 text-center">النوع</th>
                            <th class="px-4 py-2 text-center">رقم الترخيص</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($school->user as $user)
                            <tr class="border-t">
                                <td class="px-4 py-2 text-center">{{ $school->name }}</td>
                                <td class="px-4 py-2 text-center">{{ $user->name }}</td>
                                <td class="px-4 py-2 text-center">{{ $user->role }}</td>
                                <td class="px-4 py-2 text-center">{{ $user->email }}</td>
                                <td class="px-4 py-2 text-center">{{ $school->type }}</td>
                                <td class="px-4 py-2 text-center">{{ $school->License_number }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </main>
    </div>

</x-layout>
