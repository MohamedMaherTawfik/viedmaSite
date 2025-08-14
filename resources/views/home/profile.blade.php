<x-home-layout>
    {{-- Success Message --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Failure Message --}}
    @if (session('fail'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('fail') }}
        </div>
    @endif

    {{-- Any Other Error Messages --}}
    @if (session('error'))
        <div class="bg-orange-100 border border-orange-400 text-orange-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">الملف الشخصي</h1>

        <!-- روابط التنقل -->
        <nav class="flex border-b border-gray-200 mb-8">
            <button id="profileTab" class="py-2 px-4 font-medium text-blue-600 border-b-2 border-blue-600">المعلومات
                الشخصية</button>
            <button id="passwordTab" class="py-2 px-4 font-medium text-gray-500 hover:text-blue-600">تغيير كلمة
                المرور</button>
            <button id="ordersTab" class="py-2 px-4 font-medium text-gray-500 hover:text-blue-600">الطلبات</button>
        </nav>

        <!-- قسم المعلومات الشخصية -->
        <div id="profileSection" class="profile-section">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">المعلومات الشخصية</h2>
            <form class="max-w-md" action="{{ route('profile.update') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 mb-2">الاسم</label>
                    <input type="text" id="name" value="{{ Auth::user()->name }}" name="name"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="أدخل اسمك">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 mb-2">البريد الإلكتروني</label>
                    <input type="email" id="email" value="{{ Auth::user()->email }}" name="email"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="أدخل بريدك الإلكتروني">
                </div>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">حفظ
                    التغييرات</button>
            </form>
        </div>

        <!-- قسم تغيير كلمة المرور -->
        <div id="passwordSection" class="profile-section hidden">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">تغيير كلمة المرور</h2>
            <form class="max-w-md" action="{{ route('password.update') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="current_password" class="block text-gray-700 mb-2">كلمة المرور الحالية</label>
                    <input type="password" id="current_password" name="current_password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="أدخل كلمة المرور الحالية">
                </div>
                <div class="mb-4">
                    <label for="newPassword" class="block text-gray-700 mb-2">كلمة المرور الجديدة</label>
                    <input type="password" id="newPassword" name="new_password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="أدخل كلمة المرور الجديدة">
                </div>
                <div class="mb-4">
                    <label for="confirmPassword" class="block text-gray-700 mb-2">تأكيد كلمة المرور الجديدة</label>
                    <input type="password" id="confirmPassword" name="new_password_confirmation"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="أعد إدخال كلمة المرور الجديدة">
                </div>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">تغيير كلمة
                    المرور</button>
            </form>
        </div>

        <!-- قسم الطلبات -->
        <div id="ordersSection" class="profile-section hidden">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">طلباتي</h2>
            <div class="bg-white shadow rounded-lg overflow-hidden">
                @foreach ($orders as $item)
                    <div class="p-4 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-medium"> رقم الطلب: {{ $item->id }} </p>
                                <p class="text-sm text-gray-500">{{ date('Y-m-d H:i', strtotime($item->created_at)) }}
                                </p>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">مكتمل</span>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // عناصر DOM
            const profileTab = document.getElementById('profileTab');
            const passwordTab = document.getElementById('passwordTab');
            const ordersTab = document.getElementById('ordersTab');

            const profileSection = document.getElementById('profileSection');
            const passwordSection = document.getElementById('passwordSection');
            const ordersSection = document.getElementById('ordersSection');

            // وظيفة تغيير القسم النشط
            function showSection(sectionToShow) {
                // إخفاء جميع الأقسام
                document.querySelectorAll('.profile-section').forEach(section => {
                    section.classList.add('hidden');
                });

                // إظهار القسم المطلوب
                sectionToShow.classList.remove('hidden');

                // تحديث حالة أزرار التنقل
                profileTab.classList.remove('text-blue-600', 'border-blue-600');
                profileTab.classList.add('text-gray-500');
                passwordTab.classList.remove('text-blue-600', 'border-blue-600');
                passwordTab.classList.add('text-gray-500');
                ordersTab.classList.remove('text-blue-600', 'border-blue-600');
                ordersTab.classList.add('text-gray-500');

                if (sectionToShow === profileSection) {
                    profileTab.classList.add('text-blue-600', 'border-blue-600');
                    profileTab.classList.remove('text-gray-500');
                } else if (sectionToShow === passwordSection) {
                    passwordTab.classList.add('text-blue-600', 'border-blue-600');
                    passwordTab.classList.remove('text-gray-500');
                } else if (sectionToShow === ordersSection) {
                    ordersTab.classList.add('text-blue-600', 'border-blue-600');
                    ordersTab.classList.remove('text-gray-500');
                }
            }

            // إضافة مستمعي الأحداث
            profileTab.addEventListener('click', () => showSection(profileSection));
            passwordTab.addEventListener('click', () => showSection(passwordSection));
            ordersTab.addEventListener('click', () => showSection(ordersSection));

            // عرض القسم الأول افتراضيًا
            showSection(profileSection);
        });
    </script>

    <style>
        .hidden {
            display: none;
        }

        button {
            transition: all 0.3s ease;
        }

        button:hover {
            color: #3b82f6;
        }
    </style>
</x-home-layout>
