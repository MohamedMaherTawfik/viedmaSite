@php
    use App\Models\games;
    $games = games::count();
@endphp

<section class="bg-white py-12" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <div
        class="container mx-auto flex flex-col md:flex-row items-center justify-center md:space-x-16 space-y-8 md:space-y-0">

        <!-- Button + Subtext -->
        <div class="text-center">
            <button class="bg-[#176b98] hover:bg-[#055681FF] text-white font-semibold px-6 py-3 rounded-full shadow">
                {{ __('messages.see_newest') }}
            </button>
            <p class="text-sm text-gray-600 mt-2">{{ __('messages.interested') }}</p>
        </div>

        <!-- Divider -->
        <div class="hidden md:block w-px h-12 bg-gray-200"></div>

        <!-- Games Count -->
        <div class="text-center">
            <h3 class="text-2xl font-bold text-gray-900">{{ $games }}</h3>
            <p class="text-sm text-gray-600">{{ __('messages.games') }}</p>
        </div>

        <!-- Divider -->
        <div class="hidden md:block w-px h-12 bg-gray-200"></div>

        <!-- Parents Recommend -->
        <div class="text-center">
            <h3 class="text-2xl font-bold text-gray-900">99%</h3>
            <p class="text-sm text-gray-600">{{ __('messages.parents_recommend') }}</p>
        </div>

        <!-- Divider -->
        <div class="hidden md:block w-px h-12 bg-gray-200"></div>

        <!-- Reviews -->
        <div class="text-center flex flex-col items-center">
            <div class="flex -space-x-2">
                <img src="https://randomuser.me/api/portraits/women/44.jpg"
                    class="w-8 h-8 rounded-full border-2 border-white" alt="">
                <img src="https://randomuser.me/api/portraits/men/45.jpg"
                    class="w-8 h-8 rounded-full border-2 border-white" alt="">
                <img src="https://randomuser.me/api/portraits/women/46.jpg"
                    class="w-8 h-8 rounded-full border-2 border-white" alt="">
            </div>
            <p class="text-sm text-gray-600 mt-1">
                <span class="font-semibold text-gray-900">4.8 ★</span>
                {{ __('messages.from') }}
                <a href="#" class="text-blue-600 hover:underline">880 {{ __('messages.reviews') }}</a>
            </p>
        </div>

    </div>
</section>
