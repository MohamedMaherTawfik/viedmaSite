<header class="flex items-center justify-between mb-6">

    <!-- Search -->
    {{-- <input type="text"
           placeholder="{{ __('main.search') }}"
           class="px-4 py-2 rounded border w-1/3"> --}}

    <!-- Language Dropdown -->
    <div x-data="{ open: false }" class="relative">

        <!-- Button -->
        <button @click="open = !open"
                class="flex items-center gap-2 px-4 py-2 border rounded bg-white text-blue-700">
            🌍
            <span class="text-sm font-medium">
                {{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}
            </span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Dropdown Menu -->
        <div x-show="open"
             @click.outside="open = false"
             x-transition
             class="absolute right-0 mt-2 w-32 bg-white border rounded shadow-md z-50">

            <a href="{{ route('lang.switch', 'ar') }}"
               class="block px-4 py-2 text-sm hover:bg-gray-100
               {{ app()->getLocale() == 'ar' ? 'font-bold text-blue-700' : '' }}">
                العربية
            </a>

            <a href="{{ route('lang.switch', 'en') }}"
               class="block px-4 py-2 text-sm hover:bg-gray-100
               {{ app()->getLocale() == 'en' ? 'font-bold text-blue-700' : '' }}">
                English
            </a>
        </div>
    </div>

</header>
