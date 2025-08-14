<x-home-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" dir="rtl">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">عن منصة فيدما</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                حيث يلتقي التعليم بالتجارة الإلكترونية - منصة متكاملة للتعلم والتسوق
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-12 items-center mb-16">
            <div class="order-1 md:order-2">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">رؤيتنا</h2>
                <p class="text-gray-600 mb-6">
                    في فيدما، نؤمن بقوة الجمع بين المعرفة والموارد العملية.
                    نقدم منصة فريدة تجمع بين متجر إلكتروني ومنصة تعليمية متكاملة،
                    لنوفر لك مساحة واحدة لتحصيل العلم والحصول على كل ما تحتاجه.
                </p>
                <p class="text-gray-600">
                    سواء كنت طالبًا تبحث عن مواد تعليمية، أو محترفًا يحتاج لدورات متخصصة،
                    فيدما هي حلك الشامل لكل احتياجاتك التعليمية والتسوقية.
                </p>
            </div>
            <div class="order-2 md:order-1 rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset('auth/rendered_page.png') }}" alt="فيدما - التعليم والتسوق" class="w-full h-auto">
            </div>
        </div>

        <div class="bg-gray-50 rounded-xl p-8 mb-16">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-8">لماذا تختار فيدما؟</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium text-gray-800 mb-2">تعليم متكامل</h3>
                    <p class="text-gray-600">دورات تعليمية عالية الجودة في مختلف المجالات</p>
                </div>
                <div class="text-center">
                    <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium text-gray-800 mb-2">متجر إلكتروني</h3>
                    <p class="text-gray-600">كل ما تحتاجه من منتجات وكتب وأدوات تعليمية</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium text-gray-800 mb-2">تجربة سلسة</h3>
                    <p class="text-gray-600">واجهة سهلة الاستخدام تربط بين التعليم والتسوق</p>
                </div>
            </div>
        </div>

        <div class="text-center">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">انضم إلى رحلتنا التعليمية</h2>
            <p class="text-gray-600 max-w-3xl mx-auto mb-8">
                في فيدما، نعمل جاهدين لتقديم أفضل تجربة تعليمية وتسوقية لعملائنا.
                انضم إلينا اليوم وكن جزءًا من مجتمعنا المتنامي من المتعلمين والباحثين عن المعرفة.
            </p>
            <a href="/register"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-lg inline-block transition duration-300">
                سجل الآن
            </a>
        </div>
    </div>
</x-home-layout>
