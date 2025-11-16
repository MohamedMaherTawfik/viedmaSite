<x-home-layout>

    <style>
        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .bounce-hover:hover {
            animation: bounce 0.5s ease;
        }
    </style>

    {{-- Success and Error Messages --}}
    @if (session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-3 rounded bg-red-100 text-red-800 border border-red-300">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-3 rounded bg-yellow-100 text-yellow-800 border border-yellow-300">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Hero Section -->
    <section class="py-20 relative">
        <img src="{{ asset('images/schoolBack.jpg') }}" alt="Game Background"
            class="absolute inset-0 w-full h-full object-cover object-center opacity-100">
        <div class="absolute inset-0 bg-dark-blue bg-opacity-60"></div>
        <div
            class="container mx-auto px-4 relative z-10 text-center {{ app()->getLocale() == 'ar' ? 'md:text-right' : 'md:text-left' }} flex flex-col items-center justify-center h-full pt-20 pb-20">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 max-w-2xl leading-tight">
                {{ __('messages.welcome') }}
            </h1>
            <p class="text-lg text-white mb-8 max-w-xl">
                {{ __('messages.welcome_desc') }}
            </p>
            <a href="{{ route('about') }}"
                class="bg-[#1E40AF] hover:bg-[#1D4ED8] text-white font-bold py-3 px-6 rounded-lg shadow-lg transition-transform duration-300 transform hover:scale-105">
                {{ __('messages.learn_more') }}
            </a>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-dark-blue text-center mb-6">{{ __('messages.about_title') }}</h2>
            <p class="text-lg text-gray-700 text-center max-w-3xl mx-auto leading-relaxed">
                {!! __('messages.about_content') !!}
            </p>
        </div>
    </section>

    <!-- Schools Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-dark-blue text-center mb-12">{{ __('messages.schools_title') }}</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($schools as $school)
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                        <img src="{{ $school->school_logo && file_exists(storage_path('app/public/' . $school->school_logo))
                            ? asset('storage/' . $school->school_logo)
                            : 'https://www.thekeepingroomnc.com/wp-content/uploads/2020/04/image-placeholder.jpg' }}"
                            alt="{{ $school->name }}" class="w-full h-48 object-cover">

                        <div class="p-4 text-center">
                            <h3 class="text-xl font-bold text-gray-800 mb-2 truncate">{{ $school->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ $school->type }}</p>
                            <a href="{{ route('school.show', $school) }}"
                                class="inline-block bg-[#1E40AF] hover:bg-[#1D4ED8] text-white font-semibold py-2 px-4 rounded-lg transition-transform duration-300 transform hover:scale-105">
                                {{ __('messages.go_to_school') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <style>
        @keyframes float {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-6px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .float {
            animation: float 4s ease-in-out infinite;
        }

        .typewriter {
            display: inline-block;
            white-space: nowrap;
            overflow: hidden;
            max-width: 0;
            animation: typing 700ms steps(var(--chars)) 1 forwards, blink 1s steps(1) infinite;
            border-right: 2px solid rgba(0, 0, 0, 0.12);
        }

        @keyframes typing {
            from {
                max-width: 0ch;
            }

            to {
                max-width: var(--chars);
            }
        }

        @keyframes blink {
            50% {
                border-color: transparent;
            }
        }

        [x-cloak] {
            display: none !important;
        }

        .truncate {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        @media (prefers-reduced-motion: reduce) {
            .float {
                animation: none;
            }

            .typewriter {
                animation: none;
                max-width: none;
                border-right: none;
            }
        }
    </style>

</x-home-layout>
