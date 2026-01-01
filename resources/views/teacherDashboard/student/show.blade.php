<x-layout title="{{ __('main.student_details') }}">
    <!-- Sidebar -->
    <x-trainer-sidebar />

    <div class="flex flex-col flex-1">
        <main class="p-6 flex-1">
            <x-teacher-header />
            <x-messagesdata />
            <h2 class="text-2xl font-bold mb-6 text-gray-800">
                {{ __('main.student_details') }}
            </h2>

            <div class="space-y-6">
                <!-- معلومات الطالب -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('main.personal_info') }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <p class="text-gray-500 text-sm">{{ __('main.student_name') }}</p>
                            <p class="font-semibold text-gray-800 mt-1">{{ $student->me->name ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">{{ __('main.email') }}</p>
                            <p class="font-semibold text-gray-800 mt-1">{{ $student->me->email ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">{{ __('main.national_id') }}</p>
                            <p class="font-semibold text-gray-800 mt-1">{{ $student->national_id ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">{{ __('main.nationality') }}</p>
                            <p class="font-semibold text-gray-800 mt-1">{{ $student->nationallity ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">{{ __('main.parent_phone') }}</p>
                            <p class="font-semibold text-gray-800 mt-1">
                                {{ $student->parent_phone ?? __('main.not_available') }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">{{ __('main.academic_stage') }}</p>
                            <p class="font-semibold text-gray-800 mt-1">{{ $student->Academic_stage ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- أزرار التحكم -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('main.student_actions') }}</h3>

                    <div class="flex flex-wrap gap-4">
                        <button type="button" onclick="openBehaviorModal()"
                            class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg font-medium transition duration-200 flex items-center gap-2">
                            {{ __('main.behavior') }}
                        </button>

                        <button type="button" onclick="openActivityModal()"
                            class="px-6 py-3 bg-green-500 hover:bg-green-600 text-white rounded-lg font-medium transition duration-200 flex items-center gap-2">
                            {{ __('main.activity') }}
                        </button>

                        <button type="button" onclick="openInteractionModal()"
                            class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-medium transition duration-200 flex items-center gap-2">
                            {{ __('main.interaction') }}
                        </button>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6 mt-6">
                    <h3 class="text-lg font-semibold mb-4 text-yellow-600">
                        {{ __('main.behavior') }}
                    </h3>

                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-200 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-right">التاريخ</th>
                                    <th class="px-4 py-2 text-right">الوصف</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($behavior as $item)
                                    <tr class="border-t">
                                        <td class="px-4 py-2 text-gray-600">
                                            {{ $item->created_at->format('Y-m-d') }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $item->description ?? 'لا يوجد' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center py-4 text-gray-500">
                                            لا يوجد بيانات
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6 mt-6">
                    <h3 class="text-lg font-semibold mb-4 text-green-600">
                        {{ __('main.activity') }}
                    </h3>

                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-200 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-right">التاريخ</th>
                                    <th class="px-4 py-2 text-right">الوصف</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($activity as $item)
                                    <tr class="border-t">
                                        <td class="px-4 py-2 text-gray-600">
                                            {{ $item->created_at->format('Y-m-d') }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $item->description ?? '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center py-4 text-gray-500">
                                            لا يوجد بيانات
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6 mt-6">
                    <h3 class="text-lg font-semibold mb-4 text-blue-600">
                        {{ __('main.interaction') }}
                    </h3>

                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-200 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-right">التاريخ</th>
                                    <th class="px-4 py-2 text-right">الملاحظات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($interaction as $item)
                                    <tr class="border-t">
                                        <td class="px-4 py-2 text-gray-600">
                                            {{ $item->created_at->format('Y-m-d') }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $item->description ?? 'لا يوجد' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center py-4 text-gray-500">
                                            لا يوجد بيانات
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>


    <!-- Behavior Modal -->
    <div id="behaviorModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg font-bold mb-4">{{ __('main.behavior') }}</h3>

            <form action="{{ route('teacher.student.behavior', $student->me->id) }}" method="POST">
                @csrf

                <input type="hidden" name="user_id" value="{{ $student->me->id }}">

                <div class="mb-4">
                    <label class="block mb-1">الوصف</label>
                    <textarea name="description" required class="w-full border rounded p-2"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block mb-1">التاريخ</label>
                    <input type="date" name="created_at" required class="w-full border rounded p-2"
                        value="{{ now()->toDateString() }}">
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeBehaviorModal()"
                        class="px-4 py-2 bg-gray-300 rounded">إلغاء</button>

                    <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded">
                        حفظ
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- Activity Modal -->
    <div id="activityModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg font-bold mb-4">{{ __('main.activity') }}</h3>

            <form action="{{ route('teacher.student.activity', $student->me->id) }}" method="POST">
                @csrf

                <input type="hidden" name="user_id" value="{{ $student->me->id }}">

                <div class="mb-4">
                    <label class="block mb-1">تفاصيل النشاط</label>
                    <textarea name="description" required class="w-full border rounded p-2"></textarea>
                </div>

                <div class=" gap-4 mb-4">
                    <div>
                        <label class="block mb-1">التاريخ</label>
                        <input type="date" name="created_at" required class="w-full border rounded p-2"
                            value="{{ now()->toDateString() }}">
                    </div>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeActivityModal()"
                        class="px-4 py-2 bg-gray-300 rounded">إلغاء</button>

                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">
                        حفظ
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- Interaction Modal -->
    <div id="interactionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg font-bold mb-4">{{ __('main.interaction') }}</h3>

            <form action="{{ route('teacher.student.interaction', $student->me->id) }}" method="POST">
                @csrf

                <input type="hidden" name="user_id" value="{{ $student->me->id }}">

                <div class="mb-4">
                    <label class="block mb-1">ملاحظات</label>
                    <textarea name="description" required class="w-full border rounded p-2"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block mb-1">التاريخ</label>
                    <input type="date" name="created_at" required class="w-full border rounded p-2"
                        value="{{ now()->toDateString() }}">
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeInteractionModal()"
                        class="px-4 py-2 bg-gray-300 rounded">إلغاء</button>

                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
                        حفظ
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script>
        function openBehaviorModal() {
            document.getElementById('behaviorModal').classList.remove('hidden');
        }

        function closeBehaviorModal() {
            document.getElementById('behaviorModal').classList.add('hidden');
        }

        function openActivityModal() {
            document.getElementById('activityModal').classList.remove('hidden');
        }

        function closeActivityModal() {
            document.getElementById('activityModal').classList.add('hidden');
        }

        function openInteractionModal() {
            document.getElementById('interactionModal').classList.remove('hidden');
        }

        function closeInteractionModal() {
            document.getElementById('interactionModal').classList.add('hidden');
        }
    </script>

</x-layout>
