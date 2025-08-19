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
            <p class="text-lg text-gray-700 text-center max-w-3xl mx-auto mb-10 leading-relaxed">
                تُعد <span class="font-bold text-blue-700">VIEDMA</span> منصة تعليمية رائدة تهدف إلى تعزيز المعرفة
                والمهارات لدى الطلاب
                من خلال تقديم محتوى تعليمي غني ومتنوع. تعتمد المنصة على الابتكار في التعليم باستخدام أحدث الوسائل
                التكنولوجية
                لتوفير بيئة تعليمية تفاعلية تُركز على تطوير مهارات القرن الحادي والعشرين.
                <br><br>
                كما تضع <span class="font-bold text-blue-700">VIEDMA</span> دعم الطلاب في مجالات مثل <span
                    class="font-semibold">STEM</span>
                ضمن أولوياتها، حيث تقدم مواد تعليمية متنوعة تلبي احتياجاتهم المختلفة. وتسعى أيضًا إلى تعزيز الوعي
                بالقضايا
                العالمية مثل التغير المناخي والتنوع البيولوجي عبر مشاريع تعليمية مدعومة بالتكنولوجيا.
                <br><br>
                وبذلك تُعتبر <span class="font-bold text-blue-700">VIEDMA</span> أداة فعالة للطلاب والمعلمين معًا، إذ
                تمنحهم فرصًا
                حقيقية لتطوير مهاراتهم في بيئة تعليمية مبتكرة وداعمة.
            </p>


        </div>
    </section>

    <section class="my-10">
        <div class="container mx-auto px-4">
            <div x-data="{ page: 1, perPage: 3 }" class="space-y-8">

                <!-- Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($schools as $index => $school)
                        <div x-show="Math.ceil(({{ $loop->index + 1 }}) / perPage) === page"
                            class="bg-white border border-[#176b98] shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">

                            <div class="p-4 text-right">
                                <h2 class="text-lg font-bold text-[#176b98] mb-1">
                                    الاسم : {{ $school->name }}
                                </h2>
                                <p class="text-sm text-gray-700 mb-1"> النوع : {{ $school->type }}</p>
                                <p class="text-sm text-gray-700 mb-1">المسئول : {{ $school->admin?->name }} </p>
                                <p class="text-sm text-gray-700"> العنوان : {{ $school->address }}</p>

                                <button
                                    @click="$el.nextElementSibling.__x.$data.open = !$el.nextElementSibling.__x.$data.open"
                                    class="mt-3 w-full bg-[#176b98] text-white text-sm py-1.5 rounded-md hover:bg-[#FEBE35] hover:text-black transition-colors">
                                    <span x-show="!$el.nextElementSibling.__x?.$data.open">تفاصيل أكثر</span>
                                    <span x-show="$el.nextElementSibling.__x?.$data.open">إخفاء التفاصيل</span>
                                </button>

                                <!-- تفاصيل -->
                                <div x-data="{ open: false }" x-show="open" x-collapse
                                    class="mt-3 text-sm text-gray-700" style="display: none;">
                                    <p>{{ $school->description ?? 'لا توجد تفاصيل إضافية' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination Tabs -->
                <div class="flex justify-center gap-2 mt-4">
                    <template x-for="i in Math.ceil({{ count($schools) }} / perPage)" :key="i">
                        <button @click="page = i" x-text="i"
                            :class="page === i ?
                                'bg-[#176b98] text-white' :
                                'bg-[#FEBE35] text-black hover:bg-[#176b98] hover:text-white'"
                            class="px-3 py-1.5 rounded-md text-sm font-bold transition-colors"></button>
                    </template>
                </div>
            </div>
        </div>
    </section>


</x-school-layout>
