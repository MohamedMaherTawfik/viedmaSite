<footer class="bg-[#176b98] py-3 px-5 text-white">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-10 items-start">

        <!-- Quick Links -->
        <div class="text-center md:text-right">
            <h4 class="font-bold border-b-2 border-[#FEBE35] inline-block mb-5 text-lg">روابط سريعة</h4>
            <ul class="space-y-3 text-gray-100">
                <li><a href="{{ route('home') }}" class="hover:text-[#FEBE35] transition duration-300">الصفحة الرئيسية</a>
                </li>
                <li><a href="#" class="hover:text-[#FEBE35] transition duration-300">الخدمات</a></li>
                <li><a href="#" class="hover:text-[#FEBE35] transition duration-300">المتخصصين</a></li>
            </ul>
        </div>

        <!-- Support Links -->
        <div class="text-center md:text-right">
            <h4 class="font-bold border-b-2 border-[#FEBE35] inline-block mb-5 text-lg">روابط الدعم</h4>
            <ul class="space-y-3 text-gray-100">
                <li><a href="{{ route('about') }}" class="hover:text-[#FEBE35] transition duration-300">من نحن</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-[#FEBE35] transition duration-300">تواصل معنا</a>
                </li>
                <li><a href="#" class="hover:text-[#FEBE35] transition duration-300">حقوق الطبع والنشر</a></li>
                <li><a href="{{ route('web.privacy') }}"
                        class="hover:text-[#FEBE35] transition duration-300">الخصوصية</a></li>
                <li><a href="{{ route('web.terms') }}" class="hover:text-[#FEBE35] transition duration-300">الشروط
                        والأحكام</a></li>
            </ul>
        </div>

        <!-- Logo & Social -->
        <div class="text-center md:text-right">
            <!-- Logo -->
            <div class="mb-6">
                <img src="{{ asset('auth/rendered_page.png') }}" alt="Viedma Logo"
                    class="w-40 mx-auto md:mx-0 mb-4 object-contain hover:scale-105 transition-transform duration-300">
                <p class="font-semibold text-gray-100 mb-3">يمكنك متابعتنا من خلال</p>
                <!-- Social Icons -->
                <div class="flex justify-center md:justify-start gap-5">
                    <a href="#" class="text-[#FEBE35] hover:text-white transition duration-300 text-2xl"><i
                            class="fab fa-facebook-square"></i></a>
                    <a href="#" class="text-[#FEBE35] hover:text-white transition duration-300 text-2xl"><i
                            class="fab fa-instagram"></i></a>
                    <a href="#" class="text-[#FEBE35] hover:text-white transition duration-300 text-2xl"><i
                            class="fab fa-youtube"></i></a>
                    <a href="#" class="text-[#FEBE35] hover:text-white transition duration-300 text-2xl"><i
                            class="fab fa-linkedin"></i></a>
                </div>
            </div>

            <!-- App Store -->
            <p class="text-sm text-gray-100 mb-3">تطبيقاتنا</p>
            <div class="flex justify-center md:justify-start gap-4 mb-6">
                <a href="#">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Google_Play_Store_badge_EN.svg/512px-Google_Play_Store_badge_EN.svg.png"
                        alt="Google Play" class="w-36 hover:scale-105 transition-transform duration-300">
                </a>
                <a href="#">
                    <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                        alt="App Store" class="w-32 hover:scale-105 transition-transform duration-300">
                </a>
            </div>

            <!-- Copyright -->
            <p class="text-xs text-gray-200 border-t border-gray-400 pt-4">
                {{ __('messages.All rigths') }}
            </p>
        </div>
    </div>
</footer>
