<x-home-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ __('messages.title5') }}</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                {{ __('messages.subtitle5') }}
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-12 items-start">
            <div class="bg-white p-8 rounded-xl shadow-lg">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">{{ __('messages.send_message') }}</h2>

                <form class="space-y-6">
                    <div>
                        <label for="name" class="block text-gray-700 mb-2">{{ __('messages.full_name') }}</label>
                        <input type="text" id="name"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="email" class="block text-gray-700 mb-2">{{ __('messages.email') }}</label>
                        <input type="email" id="email"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="subject" class="block text-gray-700 mb-2">{{ __('messages.subject') }}</label>
                        <select id="subject"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">{{ __('messages.select_subject') }}</option>
                            <option value="support">{{ __('messages.subject_support') }}</option>
                            <option value="courses">{{ __('messages.subject_courses') }}</option>
                            <option value="products">{{ __('messages.subject_products') }}</option>
                            <option value="suggestions">{{ __('messages.subject_suggestions') }}</option>
                            <option value="other">{{ __('messages.subject_other') }}</option>
                        </select>
                    </div>

                    <div>
                        <label for="message" class="block text-gray-700 mb-2">{{ __('messages.message') }}</label>
                        <textarea id="message" rows="5"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300">
                        {{ __('messages.send_button') }}
                    </button>
                </form>
            </div>

            <div class="space-y-8">
                <!-- معلومات التواصل -->
                <div class="bg-gray-50 p-6 rounded-xl">
                    <h3 class="text-xl font-medium text-gray-800 mb-4">{{ __('messages.messages_info') }}</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="bg-blue-100 p-2 rounded-full mr-4">
                                <!-- أيقونة الهاتف -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.358 4.074a1 1 0 01-.272 1.018L8.383 10.93a11.037 11.037 0 005.657 5.657l2.153-2.153a1 1 0 011.018-.272l4.074 1.358A1 1 0 0122 16.72V20a2 2 0 01-2 2h-1C9.163 22 2 14.837 2 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-700">{{ __('messages.phone') }}</h4>
                                <p class="text-gray-600">+966 12 345 6789</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-green-100 p-2 rounded-full mr-4">
                                <!-- أيقونة الإيميل -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 12H8m8 0l-8 8m8-8l-8-8" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-700">{{ __('messages.email_label') }}</h4>
                                <p class="text-gray-600">info@viedma.sa</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-purple-100 p-2 rounded-full mr-4">
                                <!-- أيقونة الموقع -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 11c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 22s8-4.418 8-10c0-4.418-3.582-8-8-8s-8 3.582-8 8c0 5.582 8 10 8 10z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-700">{{ __('messages.address') }}</h4>
                                <p class="text-gray-600">{{ __('messages.address_text') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ساعات العمل -->
                <div class="bg-gray-50 p-6 rounded-xl">
                    <h3 class="text-xl font-medium text-gray-800 mb-4">{{ __('messages.working_hours') }}</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-700">{{ __('messages.days_sun_thu') }}</span>
                            <span class="text-gray-600">{{ __('messages.hours_sun_thu') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">{{ __('messages.friday') }}</span>
                            <span class="text-gray-600">{{ __('messages.closed') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">{{ __('messages.saturday') }}</span>
                            <span class="text-gray-600">{{ __('messages.hours_sat') }}</span>
                        </div>
                    </div>
                </div>

                <!-- تابعنا -->
                <div class="bg-gray-50 p-6 rounded-xl">
                    <h3 class="text-xl font-medium text-gray-800 mb-4">{{ __('messages.follow_us') }}</h3>
                    <div class="flex space-x-4 space-x-reverse">
                        <!-- Facebook -->
                        <a href="#"
                            class="bg-blue-600 text-white p-3 rounded-full hover:bg-blue-700 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M22 12.07C22 6.49 17.52 2 12 2S2 6.49 2 12.07c0 4.99 3.66 9.13 8.44 9.93v-7.03h-2.54v-2.9h2.54V9.41c0-2.5 1.5-3.89 3.79-3.89 1.1 0 2.24.2 2.24.2v2.47h-1.26c-1.24 0-1.63.77-1.63 1.55v1.87h2.77l-.44 2.9h-2.33v7.03C18.34 21.2 22 17.06 22 12.07z" />
                            </svg>
                        </a>
                        <!-- Instagram -->
                        <a href="#"
                            class="bg-pink-600 text-white p-3 rounded-full hover:bg-pink-700 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm4.25 6a4 4 0 1 0 0 8 4 4 0 0 0 0-8zm6.5-.25a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                            </svg>
                        </a>
                        <!-- Twitter -->
                        <a href="#"
                            class="bg-blue-400 text-white p-3 rounded-full hover:bg-blue-500 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M22.46 6c-.77.35-1.6.58-2.46.69a4.17 4.17 0 0 0 1.83-2.31 8.36 8.36 0 0 1-2.65 1.02 4.13 4.13 0 0 0-7 3.76A11.72 11.72 0 0 1 3.15 4.9a4.13 4.13 0 0 0 1.27 5.51 4.08 4.08 0 0 1-1.87-.52v.05a4.14 4.14 0 0 0 3.31 4.06 4.1 4.1 0 0 1-1.86.07 4.15 4.15 0 0 0 3.87 2.88A8.29 8.29 0 0 1 2 19.54a11.73 11.73 0 0 0 6.29 1.84c7.55 0 11.68-6.26 11.68-11.68v-.53A8.18 8.18 0 0 0 22.46 6z" />
                            </svg>
                        </a>
                        <!-- YouTube -->
                        <a href="#"
                            class="bg-red-600 text-white p-3 rounded-full hover:bg-red-700 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M10 15l5.19-3L10 9v6zm12-3c0 3.87-3.13 7-7 7H9c-3.87 0-7-3.13-7-7s3.13-7 7-7h6c3.87 0 7 3.13 7 7z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-home-layout>
