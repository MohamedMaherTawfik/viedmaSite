<x-home-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ __('messages.title4') }}</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                {{ __('messages.subtitle4') }}
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-12 items-center mb-16">
            <div class="order-1 md:order-2">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ __('messages.vision_title') }}</h2>
                <p class="text-gray-600 mb-6">{{ __('messages.vision_text1') }}</p>
                <p class="text-gray-600">{{ __('messages.vision_text2') }}</p>
            </div>
            <div class="order-2 md:order-1 rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset('images/winking-removebg-preview.png') }}" alt="{{ __('messages.image_alt') }}"
                    class="w-full h-100">
            </div>
        </div>

        <div class="bg-gray-50 rounded-xl p-8 mb-16">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-8">{{ __('messages.why_choose') }}</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium text-gray-800 mb-2">{{ __('messages.feature1_title') }}</h3>
                    <p class="text-gray-600">{{ __('messages.feature1_text') }}</p>
                </div>

                <div class="text-center">
                    <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium text-gray-800 mb-2">{{ __('messages.feature2_title') }}</h3>
                    <p class="text-gray-600">{{ __('messages.feature2_text') }}</p>
                </div>

                <div class="text-center">
                    <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium text-gray-800 mb-2">{{ __('messages.feature3_title') }}</h3>
                    <p class="text-gray-600">{{ __('messages.feature3_text') }}</p>
                </div>
            </div>
        </div>

        <div class="text-center">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">{{ __('messages.join_title') }}</h2>
            <p class="text-gray-600 max-w-3xl mx-auto mb-8">{{ __('messages.join_text') }}</p>
            <a href="/register"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-lg inline-block transition duration-300">
                {{ __('messages.join_button') }}
            </a>
        </div>
    </div>
</x-home-layout>
