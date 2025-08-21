<x-school-layout>

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
    {{-- رسالة النجاح --}}
    @if (session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- رسالة الفشل --}}
    @if (session('error'))
        <div class="mb-4 p-3 rounded bg-red-100 text-red-800 border border-red-300">
            {{ session('error') }}
        </div>
    @endif

    {{-- عرض الأخطاء من الفاليديشن --}}
    @if ($errors->any())
        <div class="mb-4 p-3 rounded bg-yellow-100 text-yellow-800 border border-yellow-300">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Hero Section with <img> as Background -->
    <section class="py-20 relative ">
        <!-- الصورة كخلفية باستخدام <img> -->
        <img src="{{ asset('images/schoolBack.jpg') }}" alt="Game Background"
            class="absolute inset-0 w-full h-full object-cover object-center opacity-100">

        <!-- Overlay أزرق شفاف -->
        <div class="absolute inset-0 bg-dark-blue bg-opacity-60"></div>

        <!-- المحتوى (النص والزر) -->
        <div
            class="container mx-auto px-4 relative z-10 text-center md:text-right flex flex-col items-center justify-center h-full pt-20 pb-20">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 max-w-2xl leading-tight">
                مرحبًا بكم في موقع فيدما
            </h1>
            <p class="text-lg text-white mb-8 max-w-xl">
                نؤمن بأن التعليم هو المفتاح لمستقبل مشرق. نوفر بيئة تعليمية حديثة تساعد طلابنا على الإبداع، التفكير،
                وتحقيق النجاح.
            </p>
            <button
                class="bg-[#1E40AF] hover:bg-[#1D4ED8] text-white font-bold py-3 px-6 rounded-lg shadow-lg transition-transform duration-300 transform hover:scale-105">
                تعرف علينا
            </button>
        </div>

    </section>

    <!-- About Us Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-dark-blue text-center mb-6">عن فيدما</h2>
            <p class="text-lg text-gray-700 text-center max-w-3xl mx-auto leading-relaxed">
                <span class="font-bold text-blue-700">VIEDMA</span> منصة تعليمية رائدة تهدف إلى تطوير مهارات الطلاب
                عبر محتوى تعليمي متنوع وتفاعلي يعتمد على أحدث التقنيات.
                تركز على مجالات مثل <span class="font-semibold">STEM</span>،
                وتعزز الوعي بالقضايا العالمية كالتغير المناخي والتنوع البيولوجي،
                لتكون أداة فعالة للطلاب والمعلمين معًا في بيئة تعليمية مبتكرة وداعمة.
            </p>
        </div>
    </section>


    <section class="my-10">
        <div class="container mx-auto px-4">
            <div x-data="{ page: 1, perPage: 3 }" class="space-y-8">

                <!-- Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($schools as $index => $school)
                        <div x-show="Math.ceil(({{ $loop->index + 1 }}) / perPage) === page" x-data="{ open: false, visible: false }"
                            x-init="setTimeout(() => visible = true, $el.dataset.delay)" data-delay="{{ $loop->index * 200 }}"
                            class="transform transition-all duration-500 ease-out">
                            <div class="relative p-4 text-right bg-white border border-[#176b98] rounded-2xl overflow-hidden shadow-md hover:shadow-xl hover:-translate-y-1 transition-transform duration-400"
                                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                                style="will-change: transform, opacity;">
                                <!-- floating wrapper (continuous float) -->
                                <div class="float relative">

                                    <!-- content -->
                                    <div class="flex items-center justify-between gap-3">


                                        <!-- center: name with typewriter effect (only visible text) -->
                                        <div class="flex-1 min-w-0">
                                            <div class="text-right">
                                                <div
                                                    class="overflow-hidden whitespace-nowrap text-lg font-bold text-[#176b98] leading-tight">
                                                    <!-- typewriter: width animates from 0ch -> Nch; CSS variable --chars set from blade -->
                                                    <span class="inline-block typewriter truncate"
                                                        style="--chars: {{ mb_strlen($school->name) }};">
                                                        {{ $school->name }}
                                                    </span>
                                                </div>


                                                <p class="text-xs text-gray-500 mt-1 truncate max-w-full">النوع: <span
                                                        class="font-medium">{{ $school->type }}</span></p>
                                            </div>
                                        </div>

                                        <!-- right: chevron / collapse trigger with hover animation -->
                                        <div class="flex-shrink-0">
                                            <button @click="open = !open" @mouseenter="$el.classList.add('scale-105')"
                                                @mouseleave="$el.classList.remove('scale-105')"
                                                class="p-2 rounded-full bg-white border border-gray-200 shadow-sm hover:shadow-md transition-transform"
                                                :aria-expanded="open">
                                                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg"
                                                    class="w-5 h-5 text-[#176b98]" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 9l-7 7-7-7" />
                                                </svg>
                                                <svg x-show="open" xmlns="http://www.w3.org/2000/svg"
                                                    class="w-5 h-5 text-[#176b98]" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 15l7-7 7 7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- collapse details -->
                                    <div x-show="open" x-collapse class="mt-3 text-sm text-gray-700">
                                        <p class="mb-3">{{ $school->city ?? 'لا توجد تفاصيل إضافية' }}</p>

                                        <div class="flex gap-2">
                                            <a href="{{ route('parent.login') }}"
                                                class="flex-1 text-center bg-[#FEBE35] text-black text-sm py-2 rounded-lg hover:bg-[#176b98] hover:text-white transition-colors">
                                                الذهاب إلى المدرسة
                                            </a>
                                            {{-- <a href="{{ route('schools.show', $school->id) }}"
                                                class="flex-1 text-center border border-[#176b98] text-[#176b98] text-sm py-2 rounded-lg hover:bg-[#176b98] hover:text-white transition-colors">
                                                عرض الملف
                                            </a> --}}
                                        </div>
                                    </div>

                                </div> <!-- end float -->
                            </div> <!-- end card wrapper -->
                        </div>
                    @endforeach
                </div>

                <!-- Pagination Tabs -->
                <div class="flex justify-center gap-2 mt-4">
                    <template x-for="i in Math.ceil({{ count($schools) }} / perPage)" :key="i">
                        <button @click="page = i" x-text="i"
                            :class="page === i ? 'bg-[#176b98] text-white' :
                                'bg-[#FEBE35] text-black hover:bg-[#176b98] hover:text-white'"
                            class="px-3 py-1.5 rounded-md text-sm font-bold transition-colors"></button>
                    </template>
                </div>

            </div>
        </div>
    </section>

    <!-- ====== إضافات CSS صغيرة للانيميشن ====== -->
    <style>
        /* floating animation (continuous up/down) */
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

        /* typewriter: animate width in ch units; uses --chars variable passed inline */
        .typewriter {
            display: inline-block;
            white-space: nowrap;
            overflow: hidden;
            max-width: 0;
            /* will expand to the number of characters */
            animation: typing 700ms steps(var(--chars)) 1 forwards, blink 1s steps(1) infinite;
            border-right: 2px solid rgba(0, 0, 0, 0.12);
        }

        /* typing — expand max-width from 0ch -> var(--chars)ch */
        @keyframes typing {
            from {
                max-width: 0ch;
            }

            to {
                max-width: var(--chars);
            }
        }

        /* subtle cursor blink */
        @keyframes blink {
            50% {
                border-color: transparent;
            }
        }

        /* smoother collapse transitions if Alpine x-collapse not present */
        [x-cloak] {
            display: none !important;
        }

        /* ensure truncated text has ellipsis */
        .truncate {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* accessible reduced motion fallback */
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



</x-school-layout>
