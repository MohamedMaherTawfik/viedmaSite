<x-school-layout>

    <section class="my-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($schools as $school)
                    <div
                        class="bg-white border border-[#176b98] shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">

                        <div class="p-4 text-right">
                            <h2 class="text-lg font-bold text-[#176b98] mb-1">
                                الاسم : {{ $school->name }}
                            </h2>
                            <p class="text-sm text-gray-700 mb-1"> النوع : {{ $school->type }}</p>
                            <p class="text-sm text-gray-700 mb-1"> المسئول : {{ $school->admin?->name }} </p>
                            <p class="text-sm text-gray-700"> العنوان : {{ $school->address }}</p>

                            <button
                                @click="$el.nextElementSibling.__x.$data.open = !$el.nextElementSibling.__x.$data.open"
                                class="mt-3 w-full bg-[#176b98] text-white text-sm py-1.5 rounded-md hover:bg-[#FEBE35] hover:text-black transition-colors">
                                <span x-show="!$el.nextElementSibling.__x?.$data.open">تفاصيل أكثر</span>
                                <span x-show="$el.nextElementSibling.__x?.$data.open">إخفاء التفاصيل</span>
                            </button>

                            <!-- تفاصيل -->
                            <div x-data="{ open: false }" x-show="open" x-collapse class="mt-3 text-sm text-gray-700"
                                style="display: none;">
                                <p>{{ $school->description ?? 'لا توجد تفاصيل إضافية' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


</x-school-layout>
