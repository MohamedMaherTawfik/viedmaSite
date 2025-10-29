<section class="bg-gray-100" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-xs uppercase tracking-wider text-amber-700 font-medium mb-2">
                {{ __('messages.exclusive_to_us') }}
            </h2>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-8">
                {{ __('messages.why_viedma') }}
            </h1>
            <p class="text-gray-700 text-lg max-w-3xl mx-auto leading-relaxed">
                {{ __('messages.intro_paragraph') }}
            </p>
        </div>

        <!-- Navigation tabs -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button
                class="px-6 py-3 bg-[#176b98] text-[#FEBE35] rounded-full text-sm font-medium hover:bg-[#094B6EFF] transition-colors duration-200">
                {{ __('messages.exclusive_deals') }}
            </button>
            <button
                class="px-6 py-3 bg-[#176b98] text-[#FEBE35] rounded-full text-sm font-medium hover:bg-[#094B6EFF] transition-colors duration-200">
                {{ __('messages.top_library') }}
            </button>
            <button
                class="px-6 py-3 bg-[#176b98] text-[#FEBE35] rounded-full text-sm font-medium hover:bg-[#094B6EFF] transition-colors duration-200">
                {{ __('messages.fast_checkout') }}
            </button>
            <button
                class="px-6 py-3 bg-[#176b98] text-[#FEBE35] rounded-full text-sm font-medium hover:bg-[#094B6EFF] transition-colors duration-200">
                {{ __('messages.community') }}
            </button>
            <button
                class="px-6 py-3 bg-[#176b98] text-[#FEBE35] rounded-full text-sm font-medium hover:bg-[#094B6EFF] transition-colors duration-200">
                {{ __('messages.support') }}
            </button>
            <button
                class="px-6 py-3 bg-[#176b98] text-[#FEBE35] rounded-full text-sm font-medium hover:bg-[#094B6EFF] transition-colors duration-200">
                {{ __('messages.events') }}
            </button>
        </div>

        <!-- Main content -->
        <div
            class="flex flex-col md:flex-row gap-10 items-start {{ app()->getLocale() === 'ar' ? 'md:flex-row-reverse' : '' }}">
            <!-- Text content -->
            <div class="md:w-1/2">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">
                    {{ __('messages.level_up') }}
                </h2>
                <p class="text-gray-700 mb-6 leading-relaxed">
                    {{ __('messages.description_1') }}
                </p>
                <p class="text-gray-700 mb-8 leading-relaxed">
                    {{ __('messages.description_2') }}
                </p>
                <a href="#"
                    class="inline-block px-6 py-3 bg-[#176b98] text-[#FEBE35] rounded-full text-sm font-medium hover:bg-[#0B496BFF] transition-colors duration-200">
                    {{ __('messages.browse_games') }}
                </a>
            </div>

            <!-- Image -->
            <div class="md:w-1/2">
                <img src="{{ asset('web/game.jpg') }}" alt="{{ __('messages.image_alt') }}"
                    class="rounded-lg shadow-md w-full h-auto object-cover">
            </div>
        </div>
    </div>
</section>
