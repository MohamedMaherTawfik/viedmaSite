<x-layout>

    <!-- Sidebar -->
    <x-trainer-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-teacher-header />

            <h1 class="text-2xl font-bold mb-6">لوحة تحكم المدرب</h1>
            <form action="{{ route('trainer.schedules.update', $sessionTime) }}" method="POST">
                @csrf

                <!-- Date Input -->
                <div class="mb-4 flex space-x-2">
                    <div class="flex-1">
                        <label for="date" class="block text-gray-700 font-medium mb-2">التاريخ</label>
                        <div class="relative">
                            <input type="date" id="date" name="date" value="{{ $sessionTime->date }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                        </div>
                    </div>
                    @error('date')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Time Input -->
                <div class="mb-4 flex space-x-2">
                    <div class="flex-1">
                        <label for="time" class="block text-gray-700 font-medium mb-2">الوقت</label>
                        <div class="relative">
                            <input type="time" id="time" name="time" value="{{ $sessionTime->time }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                        </div>
                    </div>
                    @error('date')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>


                <!-- Buttons -->
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">إضافة الموعد</button>
                </div>
            </form>
        </main>

    </div>

</x-layout>
