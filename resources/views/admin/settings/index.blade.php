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

            <div class="bg-white p-8 rounded-lg shadow-md mt-6">
                <h2 class="text-2xl font-bold mb-6 text-right">الإعدادات</h2>

                <div x-data="{ tab: 'profile' }" class="space-y-6">
                    <!-- Tabs Navigator -->
                    <div class="flex justify-center gap-4 mb-6">
                        <button @click="tab = 'profile'" class="px-4 py-2 rounded font-semibold"
                            :class="tab === 'profile' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800'">
                            الملف الشخصي
                        </button>

                        <button @click="tab = 'password'" class="px-4 py-2 rounded font-semibold"
                            :class="tab === 'password' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800'">
                            تغيير كلمة المرور
                        </button>
                    </div>

                    <!-- Profile Tab -->
                    <div x-show="tab === 'profile'" x-transition>
                        <form class="w-full max-w-3xl mx-auto" action="{{ route('admin.settings.user.update') }}"
                            method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="flex justify-center mb-6">
                                <div class="flex flex-col items-center gap-4">
                                    <label for="photo" class="cursor-pointer">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png"
                                            alt="الصورة الرمزية"
                                            class="w-32 h-32 rounded-full object-cover border border-gray-300 hover:opacity-80 transition">
                                    </label>
                                    <input type="file" id="photo" name="photo" class="hidden">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-right">
                                <div>
                                    <label class="block mb-1 font-medium">الاسم الأول</label>
                                    <input type="text" name="name" class="w-full border rounded px-4 py-2"
                                        value="{{ Auth::user()->name }}">
                                    @error('name')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block mb-1 font-medium">رقم الجوال</label>
                                    <input type="text" name="phone" class="w-full border rounded px-4 py-2"
                                        value="{{ Auth::user()->phone }}">
                                    @error('phone')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block mb-1 font-medium">البريد الإلكتروني</label>
                                    <input type="email" name="email" class="w-full border rounded px-4 py-2"
                                        value="{{ Auth::user()->email }}">
                                    @error('email')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-6 text-left">
                                <button type="submit"
                                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded">
                                    حفظ التغييرات
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Password Tab -->
                    <div x-show="tab === 'password'" x-transition>
                        <form class="w-full max-w-2xl mx-auto" method="POST"
                            action="{{ route('admin.settings.password.update') }}">
                            @csrf

                            <div class="grid grid-cols-1 gap-6 text-right">
                                <div>
                                    <label class="block mb-1 font-medium">كلمة المرور الحالية</label>
                                    <input type="password" name="current_password"
                                        class="w-full border rounded px-4 py-2">
                                    @error('current_password')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block mb-1 font-medium">كلمة المرور الجديدة</label>
                                    <input type="password" name="new_password" class="w-full border rounded px-4 py-2">
                                    @error('new_password')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block mb-1 font-medium">تأكيد كلمة المرور</label>
                                    <input type="password" name="new_password_confirmation"
                                        class="w-full border rounded px-4 py-2">
                                </div>
                            </div>

                            <div class="mt-6 text-left">
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded">
                                    تغيير كلمة المرور
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </main>


    </div>

</x-layout>
