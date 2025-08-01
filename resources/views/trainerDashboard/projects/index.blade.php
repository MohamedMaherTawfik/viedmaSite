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
                            <th scope="col" class="px-6 py-3 text-center">المتدرب</th>
                            <th scope="col" class="px-6 py-3 text-center">الدورة</th>
                            <th scope="col" class="px-6 py-3 text-center">المشروع</th>
                            <th scope="col" class="px-6 py-3 text-center">تاريخ الرفع</th>
                            <th scope="col" class="px-6 py-3 text-center">الحالة</th>
                            <th scope="col" class="px-6 py-3 text-center">الملف</th>
                            <th scope="col" class="px-6 py-3 text-center">الإجراء</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                        <!-- Row 1 -->
                        @foreach ($assignments as $item)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-6 py-4 text-center">{{ $item->user->name }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->graduationProject->course->title }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->graduationProject->title }} </td>
                                <td class="px-6 py-4 text-center">
                                    {{ $item->created_at->format('d-m-Y') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                        {{ optional($item->graduationNotes->first())->status ?? 'لم يتم التقييم بعد' }}
                                    </span>
                                </td>



                                <td class="px-6 py-4 text-center">
                                    <a href="{{ asset('storage/' . $item->file) }}" target="_blank" title="تحميل الملف">
                                        <!-- أيقونة PDF -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-6 h-6 text-red-600 hover:text-red-800 inline-block"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M6 2a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6H6z" />
                                        </svg>
                                    </a>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <button onclick="openEvaluationModal({{ $item->id }})"
                                        class="text-yellow-500 hover:text-yellow-700">
                                        تقييم
                                    </button>
                                </td>

                                <!-- تقييم Modal -->
                                <div id="evaluationModal"
                                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                                    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                                        <!-- زر إغلاق -->
                                        <button onclick="closeEvaluationModal()"
                                            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl">&times;</button>

                                        <h2 class="text-lg font-semibold mb-4">تقييم المشروع</h2>

                                        <form id="evaluationForm" action="{{ route('trainer.evaluation.store') }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="graduation_project_id"
                                                id="graduation_project_id" value="{{ $item->id }}">

                                            <div class="mb-4">
                                                <label for="note"
                                                    class="block text-sm font-medium mb-1">التقييم:</label>
                                                <input type="text" name="note" id="note" required
                                                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                            </div>

                                            <div class="text-right">
                                                <button type="submit"
                                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                                                    إرسال التقييم
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </main>

    </div>

</x-layout>

<script>
    function openEvaluationModal(projectId) {
        document.getElementById('evaluationModal').classList.remove('hidden');
        document.getElementById('project_id').value = projectId;
    }

    function closeEvaluationModal() {
        document.getElementById('evaluationModal').classList.add('hidden');
        document.getElementById('project_id').value = '';
        document.getElementById('status').value = '';
    }
</script>
