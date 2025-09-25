@php
    use App\Models\games;
    $course_4 = games::inRandomOrder()->take(4)->get();
    $newest = games::orderBy('created_at', 'desc')->take(4)->get();
@endphp

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <p class="text-sm font-medium text-[#F04A22] text-bold uppercase tracking-wider">Popular This Year</p>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2 mb-6">Don't Miss Out</h2>
            <a href="{{ route('games.all') }}"
                class="px-6 py-2 bg-[#176b98] border border-gray-300 rounded-full text-[#FEBE35] text-sm font-medium hover:bg-[#0E5379FF] transition duration-200">
                View All
            </a>
        </div>

        <!-- Subtitle -->
        <div class="text-center mb-10">
            <p class="text-sm font-medium text-gray-600 uppercase tracking-wider">most selling games</p>
        </div>

        <!-- Course Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($course_4 as $item)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
                    <img src="{{ $item->cover_image
                        ? asset('storage/' . $item->cover_image)
                        : 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=' }}"
                        alt="{{ $item->title }}" class="w-full h-48 object-cover">

                    <div class="p-5">
                        <h3 class="font-semibold text-gray-900 text-center mb-4">{{ $item->title }}</h3>
                        <div class="flex justify-center space-x-3">
                            <a href="{{ route('game.show', $item) }}"
                                class="px-4 py-2 bg-white border border-gray-300 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-200">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Subtitle -->
        <div class="text-center mb-10">
            <p class="text-sm font-medium text-gray-600 uppercase tracking-wider">our Newest Games</p>
        </div>

        <!-- Course Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($newest as $item)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
                    <img src="{{ $item->cover_image
                        ? asset('storage/' . $item->cover_image)
                        : 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=' }}"
                        alt="{{ $item->title }}" class="w-full h-48 object-cover">

                    <div class="p-5">
                        <h3 class="font-semibold text-gray-900 text-center mb-4">{{ $item->title }}</h3>
                        <div class="flex justify-center space-x-3">
                            <a href="{{ route('game.show', $item) }}"
                                class="px-4 py-2 bg-white border border-gray-300 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-200">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
