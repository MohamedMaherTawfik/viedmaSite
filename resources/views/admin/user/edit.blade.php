<x-layout title="لوحة تحكم الادمن">

    {{-- sidebar --}}
    <x-admin-sidebar />

    <div class="flex flex-col flex-1">

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Message --}}
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-admin-header />

            <form action="{{ route('admin.schools.user.update', ['school' => $user->school, 'user' => $user]) }}"
                method="POST" class="bg-white shadow-lg rounded-xl p-8 w-full max-w-4xl">
                @csrf
                <h2 class="text-2xl font-bold mb-6 text-center">إضافة مدرسة</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- User Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">الاسم</label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                        @error('name')
                            <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">البريد
                            الإلكتروني</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                        @error('email')
                            <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">الهاتف</label>
                        <input type="text" id="phone" name="phone" value="{{ $user->phone }}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                        @error('phone')
                            <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="school_id" value="{{ $user->school_id }}">
                </div>

                <!-- Submit -->
                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                        حفظ
                    </button>
                </div>
            </form>
        </main>


    </div>

</x-layout>
