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

            <form action="{{ route('admin.schools.store') }}" method="POST"
                class="bg-white shadow-lg rounded-xl p-8 w-full max-w-4xl">
                @csrf
                <h2 class="text-2xl font-bold mb-6 text-center">إضافة مدرسة</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">الاسم</label>
                        <input type="text" id="name" name="school_name"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                        @error('school_name')
                            <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">الاسم</label>
                        <input type="text" id="name" name="name"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                        @error('name')
                            <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">البريد
                            الإلكتروني</label>
                        <input type="email" id="email" name="email"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                        @error('email')
                            <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">الهاتف</label>
                        <input type="text" id="phone" name="phone"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                        @error('phone')
                            <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">العنوان</label>
                        <input type="text" id="address" name="address"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                        @error('address')
                            <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- City -->
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">المدينة</label>
                        <input type="text" id="city" name="city"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                        @error('city')
                            <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- License Number -->
                    <div>
                        <label for="license_number" class="block text-sm font-medium text-gray-700 mb-1">رقم
                            الترخيص</label>
                        <input type="text" id="license_number" name="license_number"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                        @error('license_number')
                            <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">النوع</label>
                        <select id="type" name="type"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                            <option value="">اختر النوع</option>
                            <option value="حكومي">حكومي</option>
                            <option value="أهلي">أهلي</option>
                            <option value="خاص">خاص</option>
                        </select>
                        @error('type')
                            <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">كلمة المرور</label>
                        <input type="password" id="password" name="password"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                        @error('password')
                            <div class="text-red-500 text-xs mb-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">تأكيد
                            كلمة المرور</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                    </div>

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
