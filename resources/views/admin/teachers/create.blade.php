@php
    use App\Models\School;
    $schools = School::all();
@endphp

<x-layout title="{{ __('main.admin_dashboard') }}">
    <!-- Sidebar -->
    <x-admin-sidebar />

    <!-- Wrapper for main content -->
    <div class="flex flex-col flex-1">
        <main class="p-6 flex-1">
            <x-admin-header />
            <x-messagesdata />

            <form action="{{ route('admin.teacher.store') }}" method="POST"
                class="mt-10 mx-auto bg-white p-6 rounded-lg shadow-lg space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block mb-1 text-gray-700">{{ __('main.name') }}</label>
                    <input type="text" name="name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('name') }}">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block mb-1 text-gray-700">{{ __('main.phone') }}</label>
                    <input type="text" name="phone"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('phone') }}">
                    @error('phone')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block mb-1 text-gray-700">{{ __('main.email') }}</label>
                    <input type="text" name="email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('email') }}">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block mb-1 text-gray-700">{{ __('main.password') }}</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Topic -->
                <div>
                    <label class="block mb-1 text-gray-700">{{ __('main.topic') }}</label>
                    <input type="text" name="topic"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('topic') }}">
                    @error('topic')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- School Dropdown -->
                <div>
                    <label class="block mb-1 text-gray-700">{{ __('main.school') }}</label>
                    <select name="school_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">{{ __('main.select_school') }}</option>
                        @foreach ($schools as $school)
                            <option value="{{ $school->id }}"
                                {{ old('school_id') == $school->id ? 'selected' : '' }}>
                                {{ $school->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('school_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                        {{ __('main.submit') }}
                    </button>
                </div>
            </form>

            <!-- Errors Section -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative space-y-2"
                    role="alert">
                    <strong class="font-bold">حدثت الأخطاء التالية:</strong>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </main>
    </div>
</x-layout>
