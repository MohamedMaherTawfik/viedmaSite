<!-- Services Section -->
<section x-show="activeSection === 'home'" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12 text-[#374151]">
            {{ __('messages.title') }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Education Card -->
            <div class="bg-gradient-to-br from-[#176b9820] to-[#176b9830] rounded-2xl shadow-lg card-hover fade-in">
                <div class="p-6">
                    <div class="flex justify-center mb-6">
                        <div
                            class="w-20 h-20 rounded-full bg-[#176b98] flex items-center justify-center text-white text-3xl">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-4 text-[#374151]">
                        {{ __('messages.education.title') }}
                    </h3>
                    <p class="text-[#374151b3] text-center mb-6">
                        {{ __('messages.education.description') }}
                    </p>

                    <a href="{{ route('schools') }}"
                        class="block text-center bg-[#176b98] text-white py-2 px-4 rounded-lg font-semibold hover:bg-[#145a7e] transition duration-300">
                        {{ __('messages.education.button') }}
                    </a>
                </div>
            </div>

            <!-- E-commerce Card -->
            <div class="bg-gradient-to-br from-[#FEBE3530] to-[#F04A2220] rounded-2xl shadow-lg card-hover fade-in">
                <div class="p-6">
                    <div class="flex justify-center mb-6">
                        <div
                            class="w-20 h-20 rounded-full bg-[#F04A22] flex items-center justify-center text-white text-3xl">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-4 text-[#374151]">
                        {{ __('messages.store1.title') }}
                    </h3>
                    <p class="text-[#374151b3] text-center mb-6">
                        {{ __('messages.store1.description') }}
                    </p>
                    <a href="{{ route('home') }}"
                        class="block text-center bg-[#F04A22] text-white py-2 px-4 rounded-lg font-semibold hover:bg-[#d23d1a] transition duration-300">
                        {{ __('messages.store1.button') }}
                    </a>
                </div>
            </div>

            <!-- Schools Card -->
            <div class="bg-gradient-to-br from-[#FEBE3530] to-[#176b9820] rounded-2xl shadow-lg card-hover fade-in">
                <div class="p-6">
                    <div class="flex justify-center mb-6">
                        <div
                            class="w-20 h-20 rounded-full bg-[#FEBE35] flex items-center justify-center text-white text-3xl">
                            <i class="fas fa-school"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-4 text-[#374151]">
                        {{ __('messages.training.title') }}
                    </h3>
                    <p class="text-[#374151b3] text-center mb-6">
                        {{ __('messages.training.description') }}
                    </p>

                    <a href="{{ route('web.courses') }}"
                        class="block text-center bg-[#FEBE35] text-white py-2 px-4 rounded-lg font-semibold hover:bg-[#e1a82f] transition duration-300">
                        {{ __('messages.training.button') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
