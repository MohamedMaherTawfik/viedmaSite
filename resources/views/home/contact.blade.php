<x-home-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" dir="rtl">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">تواصل معنا</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                نحن هنا لمساعدتك! تواصل مع فريق فيدما لأي استفسارات أو اقتراحات
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-12 items-start">
            <div class="bg-white p-8 rounded-xl shadow-lg">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">أرسل رسالتك</h2>

                <form class="space-y-6">
                    <div>
                        <label for="name" class="block text-gray-700 mb-2">الاسم الكامل</label>
                        <input type="text" id="name"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="email" class="block text-gray-700 mb-2">البريد الإلكتروني</label>
                        <input type="email" id="email"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="subject" class="block text-gray-700 mb-2">الموضوع</label>
                        <select id="subject"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">اختر موضوع الرسالة</option>
                            <option value="support">الدعم الفني</option>
                            <option value="courses">استفسار عن الدورات</option>
                            <option value="products">استفسار عن المنتجات</option>
                            <option value="suggestions">اقتراحات</option>
                            <option value="other">موضوع آخر</option>
                        </select>
                    </div>

                    <div>
                        <label for="message" class="block text-gray-700 mb-2">الرسالة</label>
                        <textarea id="message" rows="5"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300">
                        إرسال الرسالة
                    </button>
                </form>
            </div>

            <div class="space-y-8">
                <div class="bg-gray-50 p-6 rounded-xl">
                    <h3 class="text-xl font-medium text-gray-800 mb-4">معلومات التواصل</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="bg-blue-100 p-2 rounded-full mr-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-700">الهاتف</h4>
                                <p class="text-gray-600">+966 12 345 6789</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-green-100 p-2 rounded-full mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-700">البريد الإلكتروني</h4>
                                <p class="text-gray-600">info@viedma.sa</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-purple-100 p-2 rounded-full mr-4">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-700">العنوان</h4>
                                <p class="text-gray-600">المملكة العربية السعودية، الرياض، شارع الملك فهد</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-xl">
                    <h3 class="text-xl font-medium text-gray-800 mb-4">ساعات العمل</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-700">الأحد - الخميس</span>
                            <span class="text-gray-600">8 صباحاً - 5 مساءً</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">الجمعة</span>
                            <span class="text-gray-600">مغلق</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">السبت</span>
                            <span class="text-gray-600">10 صباحاً - 3 مساءً</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-xl">
                    <h3 class="text-xl font-medium text-gray-800 mb-4">تابعنا</h3>
                    <div class="flex space-x-4 space-x-reverse">
                        <a href="#"
                            class="bg-blue-600 text-white p-3 rounded-full hover:bg-blue-700 transition duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z">
                                </path>
                            </svg>
                        </a>
                        <a href="#"
                            class="bg-pink-600 text-white p-3 rounded-full hover:bg-pink-700 transition duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z">
                                </path>
                            </svg>
                        </a>
                        <a href="#"
                            class="bg-blue-400 text-white p-3 rounded-full hover:bg-blue-500 transition duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723 10.054 10.054 0 01-3.127 1.184 4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z">
                                </path>
                            </svg>
                        </a>
                        <a href="#"
                            class="bg-red-600 text-white p-3 rounded-full hover:bg-red-700 transition duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-home-layout>
