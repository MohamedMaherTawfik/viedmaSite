<footer class="bg-[#176b98] py-6 px-5 text-white">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-10 items-start">

        <!-- صورة حسب الصفحة -->
        @php
            $logo = '';
            if (request()->is('courses/*')) {
                $logo = 'Ai-removebg-preview.png';
            } elseif (request()->is('home/contact') || request()->is('home/about-us')) {
                $logo = 'chair-removebg-preview.png';
            } elseif (request()->is('home/store') || request()->is('home/games') || request()->is('home/game/*')) {
                $logo = 'pointing-removebg-preview.png';
            } elseif (request()->is('/')) {
                $logo = 'winking-removebg-preview.png';
            } elseif (request()->is('home/schools')) {
                $logo = 'grass-removebg-preview.png';
            }
        @endphp
        @if ($logo)
            <img src="{{ asset('images/' . $logo) }}" alt="Logo" class="h-40 w-18 mb-2 mx-auto md:mx-0">
        @endif

        <!-- Support Links -->
        <div
            class="@if (app()->getLocale() == 'ar') text-right @else text-left @endif text-center md:text-left md:rtl:text-right">
            <h4 class="font-bold border-b-2 border-[#FEBE35] inline-block mb-5 text-lg">
                {{ __('messages.support_links') }}
            </h4>
            <ul class="space-y-3 text-gray-100">
                <li><a href="{{ route('about') }}"
                        class="hover:text-[#FEBE35] transition duration-300">{{ __('messages.about') }}</a></li>
                <li><a href="{{ route('contact') }}"
                        class="hover:text-[#FEBE35] transition duration-300">{{ __('messages.contact') }}</a></li>
                <li><a href="#"
                        class="hover:text-[#FEBE35] transition duration-300">{{ __('messages.copyright') }}</a></li>
                <li><a href="{{ route('web.privacy') }}"
                        class="hover:text-[#FEBE35] transition duration-300">{{ __('messages.privacy') }}</a></li>
                <li><a href="{{ route('web.terms') }}"
                        class="hover:text-[#FEBE35] transition duration-300">{{ __('messages.terms') }}</a></li>
            </ul>
        </div>

        <!-- Quick Links -->
        <div
            class="@if (app()->getLocale() == 'ar') text-right @else text-left @endif text-center md:text-left md:rtl:text-right">
            <h4 class="font-bold border-b-2 border-[#FEBE35] inline-block mb-5 text-lg">
                {{ __('messages.quick_links') }}
            </h4>
            <ul class="space-y-3 text-gray-100">
                <li><a href="{{ route('home') }}"
                        class="hover:text-[#FEBE35] transition duration-300">{{ __('messages.home') }}</a></li>
                <li><a href="#"
                        class="hover:text-[#FEBE35] transition duration-300">{{ __('messages.services') }}</a></li>
                <li><a href="#"
                        class="hover:text-[#FEBE35] transition duration-300">{{ __('messages.specialists') }}</a></li>
            </ul>
        </div>

        <!-- Social & Apps -->
        <div
            class="@if (app()->getLocale() == 'ar') text-right @else text-left @endif text-center md:text-left md:rtl:text-right">
            <p class="font-semibold text-gray-100 mb-3">{{ __('messages.follow_us') }}</p>
            <div class="flex justify-center md:justify-start gap-5 mb-6">
                <a href="#" class="text-[#FEBE35] hover:text-white transition duration-300 text-2xl"><i
                        class="fab fa-facebook-square"></i></a>
                <a href="#" class="text-[#FEBE35] hover:text-white transition duration-300 text-2xl"><i
                        class="fab fa-instagram"></i></a>
                <a href="#" class="text-[#FEBE35] hover:text-white transition duration-300 text-2xl"><i
                        class="fab fa-youtube"></i></a>
                <a href="#" class="text-[#FEBE35] hover:text-white transition duration-300 text-2xl"><i
                        class="fab fa-linkedin"></i></a>
            </div>

            <p class="text-sm text-gray-100 mb-3">{{ __('messages.our_apps') }}</p>
            <div class="flex justify-center md:justify-start gap-4 mb-6">
                <a href="#"><img
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Google_Play_Store_badge_EN.svg/512px-Google_Play_Store_badge_EN.svg.png"
                        alt="Google Play" class="w-36 hover:scale-105 transition-transform duration-300"></a>
                <a href="#"><img
                        src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                        alt="App Store" class="w-32 hover:scale-105 transition-transform duration-300"></a>
            </div>

            <p class="text-xs text-gray-200 border-t border-gray-400 pt-4">{{ __('messages.all_rights') }}</p>
        </div>

    </div>
</footer>
