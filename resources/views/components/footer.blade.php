<footer class="bg-[#176b98] py-10 px-4 text-white">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- Quick Links -->
        <div>
            <h4 class="font-bold border-b-2 border-[#FEBE35] inline-block mb-4 text-white">روابط سريعه</h4>
            <ul class="space-y-2">
                <li><a href="{{ route('home') }}"
                        class="text-gray-100 hover:text-[#FEBE35] transition duration-300">الصفحه الرئيسيه</a></li>
                <li><a href="#" class="text-gray-100 hover:text-[#FEBE35] transition duration-300">الخدمات</a></li>
                <li><a href="#" class="text-gray-100 hover:text-[#FEBE35] transition duration-300">المتخصصين</a>
                </li>
            </ul>
        </div>

        <!-- Support & Contact -->
        <div>
            <h4 class="font-bold border-b-2 border-[#FEBE35] inline-block mb-4 text-white">لينكات الدعم</h4>
            <ul class="space-y-2">
                <li><a href="{{ route('about') }}" class="text-gray-100 hover:text-[#FEBE35] transition duration-300">من
                        نحن</a></li>
                <li><a href="{{ route('contact') }}"
                        class="text-gray-100 hover:text-[#FEBE35] transition duration-300">تواصل معنا</a></li>
                <li><a href="#" class="text-gray-100 hover:text-[#FEBE35] transition duration-300">حقوق الطبع
                        والنشر</a></li>
                <li><a href="#" class="text-gray-100 hover:text-[#FEBE35] transition duration-300">الخصوصيه</a>
                </li>
                <li><a href="#" class="text-gray-100 hover:text-[#FEBE35] transition duration-300">المساعده</a>
                </li>
            </ul>
        </div>

        <!-- Social & App Info -->
        <div class="text-center md:text-left">
            <!-- Logo -->
            <div class="mb-4">
                <img src="{{ asset('auth/rendered_page.png') }}" alt="Viedma Logo"
                    class="w-28 p-2 mx-auto md:mx-0 mb-2 bg-white rounded-full border-2 border-[#FEBE35]">
                <p class="font-semibold text-gray-100 mb-2">يمكنك متابعتنا من خلال</p>
                <!-- Social Icons -->
                <div class="flex justify-center md:justify-start gap-4 mt-2">
                    <a href="#" class="text-[#FEBE35] hover:text-white transition duration-300">
                        <i class="fab fa-facebook-square text-2xl"></i>
                    </a>
                    <a href="#" class="text-[#FEBE35] hover:text-white transition duration-300">
                        <i class="fab fa-instagram text-2xl"></i>
                    </a>
                    <a href="#" class="text-[#FEBE35] hover:text-white transition duration-300">
                        <i class="fab fa-youtube text-2xl"></i>
                    </a>
                    <a href="#" class="text-[#FEBE35] hover:text-white transition duration-300">
                        <i class="fab fa-linkedin text-2xl"></i>
                    </a>
                </div>
            </div>

            <!-- App Store Badges -->
            <p class="text-sm text-gray-100 mb-2">تطبيقاتنا</p>
            <div class="flex justify-center md:justify-start gap-4 mb-4">
                <a href="#">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Google_Play_Store_badge_EN.svg/512px-Google_Play_Store_badge_EN.svg.png"
                        alt="Google Play" class="w-32 hover:scale-105 transition-transform duration-300">
                </a>
                <a href="#">
                    <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                        alt="App Store" class="w-28 hover:scale-105 transition-transform duration-300">
                </a>
            </div>

            <!-- Copyright -->
            <p class="text-sm text-gray-100">{{ __('messages.All rigths') }}</p>
        </div>
    </div>
</footer>
