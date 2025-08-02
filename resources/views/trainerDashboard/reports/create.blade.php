<x-layout title="لوحه تحكم المدرب ">

    <!-- Sidebar -->
    <x-trainer-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-teacher-header />

            <h1 class="text-2xl font-bold mb-6">لوحة تحكم المدرب</h1>
            <form action="{{ route('trainer.report.store', ['slug' => request('slug'), 'user' => $user]) }}"
                method="POST" enctype="multipart/form-data"
                class="bg-white p-6 rounded-xl shadow-md max-w-4xl mx-auto space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- report -->
                    <div>
                        <label for="report" class="block font-medium text-gray-700 mb-1">كتابه التقرير</label>
                        <input type="text" name="report" id="report" value="{{ old('report') }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">
                        @error('report')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- user_id -->
                    <div>
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition">
                        حفظ الدورة
                    </button>
                </div>
            </form>

        </main>


    </div>

</x-layout>
