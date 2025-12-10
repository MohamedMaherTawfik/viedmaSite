<x-layout title="{{ __('main.dashboard') }}">

    <!-- Sidebar -->
    <x-admin-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-admin-header />
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

            <h1 class="text-2xl font-bold mb-6">{{ __('main.dashboard') }}</h1>

            <!-- Table Container -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3 text-center">{{ __('main.trainee') }}</th>
                            <th class="px-6 py-3 text-center">{{ __('main.course') }}</th>
                            <th class="px-6 py-3 text-center">{{ __('main.status') }}</th>
                            <th class="px-6 py-3 text-center">{{ __('main.certificate_name') }}</th>
                            <th class="px-6 py-3 text-center">{{ __('main.file') }}</th>
                            <th class="px-6 py-3 text-center">{{ __('main.action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                        @foreach ($certificates as $item)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-6 py-4 text-center">{{ $item->user->name }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->course->title }}</td>

                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                        {{ $item->status ?? __('main.not_evaluated') }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                        {{ $item->certificate ?? __('main.not_evaluated') }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                        @if ($item->file)
                                            <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                                class="text-blue-600 hover:underline">
                                                {{ __('main.view_file') }}
                                            </a>
                                        @else
                                            <span class="text-gray-500">{{ __('main.no_file') }}</span>
                                        @endif
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <button onclick="openEvaluationModal({{ $item->user->id }} )"
                                        class="text-yellow-500 hover:text-yellow-700">
                                        {{ __('main.issue_certificate') }}
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- تقييم Modal -->
            <div id="evaluationModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                    <button onclick="closeEvaluationModal()"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl">&times;</button>

                    <h2 class="text-lg font-semibold mb-4">{{ __('main.evaluate_project') }}</h2>

                    <form id="evaluationForm" action="{{ route('admin.certificate.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="teacher_id" id="teacher_id">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="status" value="{{ __('main.issued') }}">

                        <div class="mb-4">
                            <label for="certificate" class="block text-sm font-medium mb-1">{{ __('main.certificate_name') }}:</label>
                            <input type="text" name="certificate" id="certificate"
                                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            @error('certificate')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="course_id" class="block text-sm font-medium mb-1">{{ __('main.course') }}:</label>
                            <select name="courses_id" id="courses_id"
                                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                @foreach (Auth::user()->course as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('courses_id')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium mb-1">{{ __('main.upload_file') }}:</label>
                            <input type="file" name="file" id="file"
                                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            @error('file')
                                <span class="text-red-600">{{ $message }} </span>
                            @enderror
                        </div>

                        <div class="text-right">
                            <button type="submit"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                                {{ __('main.submit_evaluation') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

</x-layout>

<!-- JavaScript -->
<script>
    function openEvaluationModal(teacherId) {
        document.getElementById('evaluationModal').classList.remove('hidden');
        document.getElementById('teacher_id').value = teacherId;
    }

    function closeEvaluationModal() {
        document.getElementById('evaluationModal').classList.add('hidden');
        document.getElementById('evaluationForm').reset();
    }
</script>
