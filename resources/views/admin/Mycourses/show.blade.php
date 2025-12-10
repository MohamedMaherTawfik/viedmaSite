<x-layout title=" {{ __('main.admin_dashboard') }}">

    <!-- Sidebar -->
    <x-admin-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">
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

     <!-- Main Content -->
<main class="p-6 flex-1 space-y-8">
    <h1 class="text-2xl font-bold mb-6">{{ __('main.trainer_dashboard') }}</h1>

    <!-- معلومات الدورة الأساسية -->
    <div class="bg-white rounded-xl shadow p-6 space-y-4">
        <h2 class="text-xl font-bold">{{ __('main.basic_course_info') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-center">
            <div>
                <p class="text-gray-500">{{ __('main.course_name') }}</p>
                <p class="font-semibold">{{ $course->title ?? __('main.not_defined') }}</p>
            </div>
            <div>
                <p class="text-gray-500">{{ __('main.course_description') }}</p>
                <p class="text-sm">
                    {{ \Illuminate\Support\Str::limit($course->description ?? __('main.not_defined'), 20, '...') }}
                </p>
            </div>
            <div>
                <p class="text-gray-500">{{ __('main.start_date') }}</p>
                <p class="font-semibold">{{ $course->start_Date ?? __('main.not_defined') }}</p>
            </div>
            <div>
                <p class="text-gray-500">{{ __('main.duration') }}</p>
                <p class="font-semibold">{{ $course->duration ?? __('main.not_defined') }} {{ __('main.hours') }}</p>
            </div>
            <div>
                <p class="text-gray-500">{{ __('main.status') }}</p>
                <p class="text-green-600 font-bold">{{ $course->status ?? __('main.not_defined') }}</p>
            </div>
            <div>
                <p class="text-gray-500">{{ __('main.level') }}</p>
                <p class="text-green-600 font-bold">{{ $course->level ?? __('main.not_defined') }}</p>
            </div>
        </div>
    </div>

    <!-- محاور الدورة / جدول الدروس -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold mb-4">{{ __('main.course_lessons') }}</h2>
        <table class="w-full text-center table-auto border">
            <thead>
                <tr class="bg-gray-100">
                    <th>{{ __('main.lesson_number') }}</th>
                    <th class="py-2">{{ __('main.lesson_title') }}</th>
                    <th>{{ __('main.attached_file') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($course->lessons as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->title ?? __('main.not_defined') }}</td>
                        <td class="flex items-center gap-3">
                            <!-- زر المشاهدة -->
                            <a href="{{ route('admin.lesson.show', $item) }}"
                               class="inline-flex items-center gap-1 bg-green-500 hover:bg-green-600 text-white text-sm font-medium px-3 py-1.5 rounded-lg shadow transition duration-200">
                                👁️ {{ __('main.view') }}
                            </a>

                            <!-- فورم الحذف -->
                            <form action="{{ route('admin.lesson.destroy', $item) }}" method="POST"
                                  onsubmit="return confirm('{{ __('main.confirm_delete_lesson') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white text-sm font-medium px-3 py-1.5 rounded-lg shadow transition duration-200">
                                    🗑️ {{ __('main.delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-8">
            <a href="{{ route('admin.lesson.create', $course) }}"
               class="mt-4 bg-blue-600 text-white py-2 px-4 rounded">+ {{ __('main.add_lesson') }}</a>
        </div>
    </div>

    <!-- مواعيد الجلسات التدريبية -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold mb-4">{{ __('main.training_sessions') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($course->sessionTime as $item)
                <div class="bg-gray-50 p-4 rounded shadow">
                    <p><strong>{{ __('main.zoom_link') }}</strong> - {{ $item->date ?? __('main.not_defined') }} </p>
                    <p class="text-green-600">- {{ $item->time ?? __('main.not_defined') }}</p>
                </div>
            @endforeach
        </div>
        <div class="mt-16">
            <a href="{{ route('admin.schedules.create', $course) }}"
               class="inline-block bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                {{ __('main.add_new_session') }}
            </a>
        </div>
    </div>

    <!-- الملفات التدريبية المرفقة -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold mb-4">{{ __('main.attached_files') }}</h2>
        <table class="w-full text-center table-auto border">
            <thead class="bg-gray-100">
                <tr>
                    <th>{{ __('main.student_name') }}</th>
                    <th>{{ __('main.file') }}</th>
                    <th>{{ __('main.feedback_notes') }}</th>
                    <th>{{ __('main.grade') }}</th>
                    <th>{{ __('main.date') }}</th>
                    <th>{{ __('main.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($uploads as $item)
                    <tr>
                        <td>{{ $item->user->name ?? __('main.not_defined') }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $item->file) }}"
                               class="inline-block px-4 py-2 bg-yellow-500 text-white font-medium rounded-lg hover:bg-yellow-600 transition">
                                {{ __('main.project_file') }}
                            </a>
                        </td>
                        <td>{{ $item->feedback ?? __('main.not_defined') }}</td>
                        <td>{{ $item->grade ?? __('main.not_defined') }}</td>
                        <td>{{ $item->created_at ?? __('main.not_defined') }}</td>
                        <td>
                            <!-- الزر -->
                            <button onclick="openModal('{{ $item->id }}')"
                                    class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                <i class="fas fa-comment-dots mr-1"></i> {{ __('main.feedback') }}
                            </button>

                            <!-- المودال -->
                            <div id="feedbackModal-{{ $item->id }}"
                                 class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                                <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-6 relative">
                                    <button onclick="closeModal('{{ $item->id }}')"
                                            class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl">&times;</button>

                                    <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">{{ __('main.add_feedback') }}</h2>

                                    <form action="{{ route('admin.feedback', $item) }}" method="POST" class="space-y-4">
                                        @csrf
                                        <div>
                                            <label for="grade-{{ $item->id }}" class="block text-sm font-medium text-gray-700 mb-1">{{ __('main.grade') }}</label>
                                            <input type="number" name="grade" id="grade-{{ $item->id }}" required
                                                   class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                        </div>
                                        <div>
                                            <label for="feedback-{{ $item->id }}" class="block text-sm font-medium text-gray-700 mb-1">{{ __('main.feedback') }}</label>
                                            <textarea name="feedback" id="feedback-{{ $item->id }}" rows="3" required
                                                      class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                                        </div>
                                        <div class="flex justify-end space-x-2">
                                            <button type="button" onclick="closeModal('{{ $item->id }}')"
                                                    class="px-3 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition">
                                                {{ __('main.cancel') }}
                                            </button>
                                            <button type="submit"
                                                    class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                                {{ __('main.submit') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <script>
                                function openModal(id) {
                                    document.getElementById('feedbackModal-' + id).classList.remove('hidden');
                                }

                                function closeModal(id) {
                                    document.getElementById('feedbackModal-' + id).classList.add('hidden');
                                }
                            </script>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- مشروع التخرج المطلوب -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold mb-4">{{ __('main.graduation_project') }}</h2>

        @foreach ($course->graduationProject as $item)
            <div class="border rounded-lg bg-gray-50 p-4 mb-4 flex justify-between items-start">
                <div>
                    <p><strong>{{ __('main.project_title') }}: </strong>{{ $item->title ?? __('main.not_defined') }}</p>
                    <p class="text-sm text-gray-600"><strong>{{ __('main.project_description') }}: </strong>{{ $item->description ?? __('main.not_defined') }}</p>
                    <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="text-green-600 mt-2 inline-block">
                        {{ __('main.download') }}
                    </a>
                </div>

                <!-- زر الحذف -->
                <div class="flex items-center space-x-3">
                    <form action="{{ route('admin.project.delete', $item) }}" method="POST"
                          onsubmit="return confirm('{{ __('main.confirm_delete_project') }}');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-3 py-2 mr-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach

        <div class="mt-10">
            <a href="{{ route('admin.project.create', $course) }}"
               class="mt-4 bg-blue-600 text-white py-2 px-4 rounded">{{ __('main.add_new_file') }}</a>
        </div>
    </div>

    <!-- المتدربين المسجلين -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold mb-4">{{ __('main.registered_students') }}</h2>
        <table class="w-full text-center table-auto border">
            <thead class="bg-gray-100">
                <tr>
                    <th>{{ __('main.name') }}</th>
                    <th>{{ __('main.certificate') }}</th>
                    <th>{{ __('main.review') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($course->enrollments as $item)
                    <tr>
                        <td>{{ $item->user->name ?? __('main.not_defined') }}</td>
                        <td>
                            @if ($item->user && $item->user->reviews && $item->user->reviews->file)
                                <a href="{{ $item->user->reviews->file }}" class="text-green-600">{{ __('main.download') }}</a>
                            @else
                                <span class="text-gray-500">{{ __('main.no_file') }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.report.create', ['slug' => $item->course->slug, 'user' => $item->user]) }}"
                               class="text-red-600 font-bold">{{ __('main.add') }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

    </div>

</x-layout>
