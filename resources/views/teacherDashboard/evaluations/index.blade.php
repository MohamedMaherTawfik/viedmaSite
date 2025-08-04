<x-layout title="لوحه تحكم المعلم ">

    <!-- Sidebar -->
    <x-school-sidebar />

    <div class="flex flex-col flex-1">
        <main class="p-6 flex-1">
            <x-school-header />

            <section class="bg-white p-4 rounded shadow mt-6 overflow-visible relative z-[1]">
                <div class="overflow-x-auto overflow-visible relative z-[1]">
                    <table class="min-w-full text-sm text-right border-separate border-spacing-y-2">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 rounded-r-lg">اسم الطالب</th>
                                <th class="px-4 py-2 text-center">الرقم القومي</th>
                                <th class="px-4 py-2 text-center">المرحله</th>
                                <th class="px-4 py-2 text-center">ولي الامر</th>
                                <th class="pr-8 pl-4 py-2 rounded-l-lg text-center">إجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr class="bg-gray-50 text-gray-800" data-student-name="{{ $student->name }}"
                                    data-student-id="{{ $student->id }}">
                                    <td class="px-4 py-2 flex items-center gap-2 text-center">
                                        <img src="https://th.bing.com/th/id/R.4b6a7d8dc6ff6bd305a872c783d2f450?rik=IcLvZ3InG%2bn33g&pid=ImgRaw&r=0"
                                            class="w-8 h-8 rounded-full" alt="">
                                        {{ $student->name }}
                                    </td>
                                    <td class="px-4 py-2 text-center">{{ $student->national_id }}</td>
                                    <td class="px-4 py-2 text-center">{{ $student->Academic_stage }}</td>
                                    <td class="px-4 py-2 text-center">
                                        {{ $student->user->phone ?? 'لم يتم الربط بولي امر' }}
                                    </td>
                                    <td class="text-center">
                                        <button type="button"
                                            class="evaluate-btn text-blue-600 hover:underline focus:outline-none">
                                            تقييم
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Modal -->
                    <div id="evaluation-modal"
                        class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                        <div class="bg-white rounded-lg w-full max-w-md p-6 relative">
                            <h2 class="text-lg font-bold mb-4">تقييم الطالب: <span id="student-name"></span></h2>
                            <form id="evaluation-form" action="{{ route('teacher.evaluation.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="student_id" id="student-id">
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                                <label for="report" class="block mb-2 text-sm font-medium text-gray-700">أدخل
                                    التقييم</label>
                                <input type="text" name="report" id="report"
                                    class="w-full border border-gray-300 rounded px-4 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                @error('report')
                                    <span class="text-red-600">{{ $message }}</span>
                                @enderror

                                <label for="file" class="block mb-2 text-sm font-medium text-gray-700">ارفق
                                    ملف (اختياري)</label>
                                <input type="file" name="file" id="file"
                                    class="w-full border border-gray-300 rounded px-4 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500" />

                                <div class="flex justify-end gap-2">
                                    <button type="button" id="close-modal"
                                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded">
                                        إلغاء
                                    </button>
                                    <button type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                        حفظ التقييم
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>

                    <!-- Scripts -->
                    <script>
                        document.querySelectorAll('.evaluate-btn').forEach(button => {
                            button.addEventListener('click', function() {
                                const tr = button.closest('tr');
                                const studentName = tr.dataset.studentName;
                                const studentId = tr.dataset.studentId;

                                document.getElementById('student-name').textContent = studentName;
                                document.getElementById('student-id').value = studentId;

                                document.getElementById('evaluation-modal').classList.remove('hidden');
                                document.getElementById('evaluation-modal').classList.add('flex');
                            });
                        });

                        document.getElementById('close-modal').addEventListener('click', function() {
                            document.getElementById('evaluation-modal').classList.add('hidden');
                            document.getElementById('evaluation-modal').classList.remove('flex');
                        });
                    </script>
                </div>
            </section>
        </main>
    </div>

</x-layout>
