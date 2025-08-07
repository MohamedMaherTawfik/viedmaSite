@php
    use App\Models\orders;
    $orders = orders::where('user_id', Auth::id())->get();
@endphp

<x-layout title="إعدادات ولي الأمر">

    <x-parent-sidebar />

    <div class="flex flex-col flex-1 bg-gray-100 min-h-screen">
        <main class="p-6 flex-1">
            <x-parent-header />

            {{-- رسالة النجاح --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- رسالة الفشل --}}
            @if (session('failed'))
                <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded mb-4">
                    {{ session('failed') }}
                </div>
            @endif


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

                        <button @click="tab = 'orders'" class="px-4 py-2 rounded font-semibold"
                            :class="tab === 'orders' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800'">
                            طلباتي
                        </button>
                    </div>

                    <!-- Profile Tab -->
                    <div x-show="tab === 'profile'" x-transition>
                        <form class="w-full max-w-3xl mx-auto" action="{{ route('parent.setting.store') }}"
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
                            action="{{ route('parent.setting.password') }}">
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

                    <!-- Orders Tab -->
                    <div x-show="tab === 'orders'" x-transition>
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($orders ?? [] as $order)
                                <div class="bg-gray-50 border rounded-lg p-4 shadow text-right">
                                    <h4 class="font-bold text-lg mb-2">طلب رقم #{{ $order->id }}</h4>
                                    <p><strong>التاريخ: </strong> {{ $order->created_at->format('Y-m-d') }}</p>
                                    <p><strong>المبلغ: </strong> {{ $order->price }} دينار اردني</p>
                                    <p><strong>العدد: </strong> {{ $order->quantity }} العاب</p>

                                    <a href="{{ route('parent.order', $order) }}"
                                        class="inline-block mt-3 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded transition duration-300">
                                        عرض التفاصيل
                                    </a>
                                </div>
                            @endforeach


                            @if (empty($orders) || count($orders) === 0)
                                <p class="text-center text-gray-500 col-span-full">لا توجد طلبات حالياً.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

</x-layout>
