<x-layout title="{{ __('main.honors') }}">

    <x-trainer-sidebar />

    <div class="flex flex-col flex-1">
        <main class="p-6 flex-1">
            <x-teacher-header />
            <x-messagesdata />

            <h2 class="text-2xl font-bold mb-6 text-gray-800">
                {{ __('main.honors_list') }}
            </h2>

            <div class="bg-white rounded-lg shadow overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-6 py-3">{{ __('main.student_name') }}</th>
                            <th class="px-6 py-3">{{ __('main.student_email') }}</th>
                            <th class="px-6 py-3">{{ __('main.academic_stage') }}</th>
                            <th class="px-6 py-3 text-center">{{ __('main.actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($honors as $honor)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium">
                                    {{ $honor->student->name ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $honor->student->email ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $honor->student?->studentMe?->academicStage?->name ?? '-' }}
                                </td>


                                <td class="px-6 py-4 text-center">
                                    {{-- Remove from honors --}}
                                    <form action="{{ route('teacher.honors.delete', $honor) }}" method="POST"
                                        onsubmit="return confirm('{{ __('main.confirm_remove_honor') }}')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition flex items-center gap-2 mx-auto">
                                            <i class="fas fa-trash"></i>
                                            {{ __('main.remove') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                                    {{ __('main.no_honors_found') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </main>
    </div>

</x-layout>
