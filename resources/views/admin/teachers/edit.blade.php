 @php
     use App\Models\school;
     $schools = school::all();
 @endphp
 <x-layout title="{{ __('main.admin_dashboard') }}">
     <!-- Sidebar -->
     <x-admin-sidebar />

     <!-- Wrapper for main content with flex column -->
     <div class="flex flex-col flex-1">

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

    <form action="{{ route('admin.teacher.update', $teacher) }}" method="POST"
        class="mt-10 mx-auto bg-white p-6 rounded-lg shadow-lg space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label class="block mb-1 text-gray-700">{{ __('main.name') }}</label>
            <input type="text" name="name"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ $teacher->name ?? 'لا يوجد اسم' }}">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block mb-1 text-gray-700">{{ __('main.email') }}</label>
            <input type="text" name="email"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ $teacher->email ?? 'لا يوجد بريد الكتروني' }}">
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Phone -->
        <div>
            <label class="block mb-1 text-gray-700">{{ __('main.phone') }}</label>
            <input type="text" name="phone"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ $teacher->phone ?? 'لا يوجد هاتف' }}">
            @error('phone')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Topic -->
        <div>
            <label class="block mb-1 text-gray-700">{{ __('main.topic') }}</label>
            <input type="text" name="topic"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ $teacher->apply->topic ?? 'لا يوجد موضوع' }}">
            @error('topic')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- School Dropdown -->
        <div>
            <label class="block mb-1 text-gray-700">{{ __('main.school') }}</label>
            <select name="school_id"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="{{ $teacher->school->id ?? '' }}">
                    {{ $teacher->school->name ?? __('main.select_school') }}
                </option>
                @foreach ($schools as $school)
                    <option value="{{ $school->id }}">{{ $school->name }}</option>
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
</main>

     </div>

 </x-layout>
