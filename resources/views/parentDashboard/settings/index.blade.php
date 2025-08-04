<x-layout title="لوحة تحكم ولي الأمر">

    <!-- Sidebar -->
    <x-parent-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-parent-header />

            <div class="bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-6 text-right">الإعدادات</h2>

                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Right: الصورة -->


                    <!-- Left: النموذج -->
                    <div class="flex-1">
                        <form class="w-full max-w-3xl mx-auto" action="{{ route('parent.setting.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- صورة الملف الشخصي في الأعلى -->
                            <div class="flex justify-center mb-6">
                                <div class="flex flex-col items-center gap-4">
                                    <label for="photo" class="cursor-pointer">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541"
                                            alt="الصورة الرمزية"
                                            class="w-32 h-32 rounded-full object-cover border border-gray-300 hover:opacity-80 transition">
                                    </label>
                                    <input type="file" id="photo" name="photo" class="hidden">
                                </div>
                            </div>

                            <!-- الحقول في شبكة -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-right">

                                <div>
                                    <label class="block mb-1 font-medium">الاسم الأول</label>
                                    <input type="text" name="name" class="w-full border rounded px-4 py-2"
                                        value="{{ Auth::user()->name }}">
                                    @error('name')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block mb-1 font-medium">رقم الجوال</label>
                                    <input type="text" name="phone" class="w-full border rounded px-4 py-2"
                                        value="{{ Auth::user()->phone }}">
                                    @error('phone')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block mb-1 font-medium">البريد الإلكتروني</label>
                                    <input type="email" name="email" class="w-full border rounded px-4 py-2"
                                        value="{{ Auth::user()->email }}">
                                    @error('email')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block mb-1 font-medium">اسم المدرسه</label>
                                    <p class="w-full border rounded px-4 py-2 bg-gray-100">
                                        {{ Auth::user()->school->name }}
                                    </p>
                                </div>

                            </div>

                            <!-- زر الحفظ -->
                            <div class="mt-8 text-center">
                                <button type="submit"
                                    class="bg-blue-600 text-white px-8 py-2 rounded hover:bg-blue-700 transition">
                                    حفظ
                                </button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </main>


    </div>

</x-layout>
