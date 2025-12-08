<header class="flex items-center justify-between mb-6">
    <input type="text" placeholder="ابحث داخل لوحة التحكم" class="px-4 py-2 rounded border w-1/3">

    <div class="flex items-center gap-3" x-data="{ open: false }">
        <div class="text-blue-700 font-bold text-lg">لوحه تحكم الادمن</div>

        <!-- Language Dropdown -->
        <div class="relative">
            <button @click="open = !open"
                class="px-4 py-1.5 rounded-md text-white text-sm font-semibold flex items-center gap-2"
                style="background-color:#176b98">
                🌐 {{ app()->getLocale() === 'ar' ? 'العربية' : 'English' }}
                <i class="fa-solid fa-chevron-down text-xs"></i>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" @click.away="open = false" x-cloak
                class="absolute mt-2 w-32 bg-white border rounded-md shadow-lg overflow-hidden z-50
                       {{ app()->getLocale() === 'ar' ? 'right-0' : 'left-0' }}">

                <a href="{{ route('lang.switch', 'ar') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                    العربية
                </a>

                <a href="{{ route('lang.switch', 'en') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                    English
                </a>
            </div>
        </div>
    </div>
</header>
