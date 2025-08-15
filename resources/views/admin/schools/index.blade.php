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

            <!-- زر إنشاء حساب مدرسة -->
            <div class="mt-4 mb-6">
                <a href="{{ route('admin.schools.create') }}"
                    class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    إنشاء حساب مدرسة
                </a>
            </div>

            <div class="bg-white shadow-lg rounded-xl p-6 mt-6">
                <h2 class="text-2xl font-bold mb-4">قائمة المدارس</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border text-center">الاسم</th>
                                <th class="px-4 py-2 border text-center">البريد الإلكتروني</th>
                                <th class="px-4 py-2 border text-center">المدير</th>
                                <th class="px-4 py-2 border text-center">العنوان</th>
                                <th class="px-4 py-2 border text-center">المدينة</th>
                                <th class="px-4 py-2 border text-center">رقم الترخيص</th>
                                <th class="px-4 py-2 border text-center">النوع</th>
                                <th class="px-4 py-2 border text-center">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($schools as $school)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border text-center">{{ $school->name }}</td>
                                    <td class="px-4 py-2 border text-center">{{ $school->user->first()->email }}</td>
                                    <td class="px-4 py-2 border text-center">{{ $school->user->first()->name }}</td>
                                    <td class="px-4 py-2 border text-center">{{ $school->address }}</td>
                                    <td class="px-4 py-2 border text-center">{{ $school->city }}</td>
                                    <td class="px-4 py-2 border text-center">{{ $school->License_number }}</td>
                                    <td class="px-4 py-2 border text-center">{{ $school->type }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <a href="{{ route('admin.schools.show', $school) }}"
                                            class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-eye text-lg"></i>
                                        </a>
                                    </td>


                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-3 text-center text-gray-500">
                                        لا توجد مدارس مسجلة
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>



    </div>

</x-layout>
