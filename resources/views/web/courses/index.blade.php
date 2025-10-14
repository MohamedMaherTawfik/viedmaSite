@php
    use Illuminate\Support\Str;
    use Carbon\Carbon;

    $coursesForJs = ($courses ?? collect())
        ->map(function ($course) {
            return [
                'id' => $course->id,
                'title' => $course->title,
                'description' => $course->description,
                'description_short' => Str::limit($course->description, 50),
                'price' => (int) ($course->price ?? 0),
                'level' => ucfirst($course->level ?? 'Beginner'),
                'category_name' => $course->category->name ?? 'General',
                'cover_photo' =>
                    $course->cover_photo && file_exists(public_path('storage/' . $course->cover_photo))
                        ? asset('storage/' . $course->cover_photo)
                        : 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=',
                'duration' => $course->duration ?? 0,
                'instructor' => $course->user->name ?? '—',
                'rating' => $course->rating ?? 0,
                'reviews_count' => $course->reviews_count ?? 0,
                'url' => isset($course->slug) ? route('web.courses.show', $course->slug) : null,
                'start_date_formatted' => $course->start_date
                    ? Carbon::parse($course->start_date)->format('d M Y')
                    : null,
            ];
        })
        ->values()
        ->toArray();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-50" x-data="courseFilter()" x-cloak>
    <x-navbar />
    <section class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="text-center lg:text-left mb-6">
                <h2 class="text-3xl font-bold text-gray-900">{{ __('messages.featured') }}</h2>
                <p class="text-gray-600">{{ __('messages.boost') }}</p>
            </div>

            <!-- Main Content: Filters (Left) + Courses (Right) -->
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Filters Sidebar -->
                <div class="w-full lg:w-64 flex-shrink-0">
                    <div class="bg-white p-5 rounded-lg shadow sticky top-6">
                        <!-- Search -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Search Courses</label>
                            <input type="text" x-model="search" placeholder="Course name..."
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-[#176b98] focus:border-transparent">
                        </div>

                        <!-- Level -->
                        <div class="mb-6">
                            <h3 class="text-gray-600 text-sm font-medium mb-3">Level</h3>
                            <div class="flex flex-wrap gap-2">
                                <button @click="level = level === 'Beginner' ? '' : 'Beginner'"
                                    :class="{
                                        'bg-blue-600 text-white border-blue-600': level === 'Beginner',
                                        'border border-blue-300 text-blue-600 hover:bg-blue-50': level !== 'Beginner'
                                    }"
                                    class="px-3 py-1.5 text-sm rounded-md transition-colors">
                                    Beginner
                                </button>
                                <button @click="level = level === 'Mid' ? '' : 'Mid'"
                                    :class="{
                                        'bg-blue-600 text-white border-blue-600': level === 'Mid',
                                        'border border-blue-300 text-blue-600 hover:bg-blue-50': level !== 'Mid'
                                    }"
                                    class="px-3 py-1.5 text-sm rounded-md transition-colors">
                                    Mid
                                </button>
                                <button @click="level = level === 'Advanced' ? '' : 'Advanced'"
                                    :class="{
                                        'bg-blue-600 text-white border-blue-600': level === 'Advanced',
                                        'border border-blue-300 text-blue-600 hover:bg-blue-50': level !== 'Advanced'
                                    }"
                                    class="px-3 py-1.5 text-sm rounded-md transition-colors">
                                    Advanced
                                </button>
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="mb-6">
                            <h3 class="text-gray-600 text-sm font-medium mb-3">CATEGORIES</h3>
                            <div class="space-y-2 max-h-60 overflow-y-auto pr-1">
                                @foreach ($categories as $item)
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="checkbox" x-model="selectedCategories"
                                            :value="'{{ $item->name }}'"
                                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                                        <span class="text-gray-700 text-sm">{{ $item->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Price: <span x-text="minPrice"></span> – <span x-text="maxPrice"></span> SAR
                            </label>
                            <div class="flex items-center gap-2 mb-1">
                                <input type="range" min="0" :max="globalMaxPrice" x-model="minPrice"
                                    @input="if (minPrice > maxPrice) maxPrice = minPrice"
                                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                                <input type="range" min="0" :max="globalMaxPrice" x-model="maxPrice"
                                    @input="if (maxPrice < minPrice) minPrice = maxPrice"
                                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                            </div>
                            <div class="flex justify-between text-xs text-gray-500">
                                <span>0 SAR</span>
                                <span x-text="globalMaxPrice + ' SAR'"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Courses Grid -->
                <div class="flex-1">
                    <div>
                        <!-- Loading Skeleton -->
                        <template x-if="isLoading">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                <template x-for="i in 6" :key="i">
                                    <div class="animate-pulse bg-white rounded-lg shadow-md h-96 p-6">
                                        <div class="h-40 bg-gray-300 rounded mb-4"></div>
                                        <div class="h-4 bg-gray-300 rounded w-3/4 mb-2"></div>
                                        <div class="h-4 bg-gray-300 rounded w-1/2 mb-2"></div>
                                        <div class="h-4 bg-gray-300 rounded w-1/4"></div>
                                    </div>
                                </template>
                            </div>
                        </template>

                        <!-- Filtered Courses -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" x-show="!isLoading">
                            <template x-for="course in filteredCourses" :key="course.id">
                                <div
                                    class="bg-white rounded-lg shadow-md transition hover:shadow-xl overflow-hidden flex flex-col">
                                    <div class="relative h-48 overflow-hidden">
                                        <img :src="course.cover_photo"
                                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                                        <div class="absolute bottom-2 left-2 bg-[#000000C5] text-white text-xs px-2 py-1 rounded"
                                            x-text="course.start_date_formatted">
                                        </div>
                                        <div class="absolute bottom-2 right-2 bg-[#000000B9] text-white text-xs px-2 py-1 rounded"
                                            x-text="course.level">
                                        </div>
                                    </div>
                                    <div class="p-6 flex-1 flex flex-col justify-between">
                                        <div>
                                            <span
                                                class="inline-block mb-2 px-3 py-1 text-xs font-semibold text-[#FEBE35] bg-[#176b98] rounded-full"
                                                x-text="course.category_name">
                                            </span>
                                            <h3 class="text-xl font-semibold text-gray-900" x-text="course.title"></h3>
                                            <p class="text-gray-600 text-sm mb-3 line-clamp-3"
                                                x-text="course.description_short"></p>
                                            <p class="text-sm text-gray-500 mb-2 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v3.586a1 1 0 00.293.707l2 2a1 1 0 001.414-1.414L11 9.586V6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span x-text="course.duration + ' hours'"></span>
                                            </p>
                                        </div>
                                        <div
                                            class="mt-auto border-t pt-4 text-sm text-gray-700 flex justify-between items-center">
                                            <div>
                                                <span class="font-bold">Instructor:</span>
                                                <span class="opacity-60" x-text="course.instructor"></span>
                                            </div>
                                            <div class="flex items-center">
                                                <span class="text-yellow-400">★</span>
                                                <span class="ml-1 text-gray-600"
                                                    x-text="course.rating + ' (' + course.reviews_count + ')'"></span>
                                            </div>
                                        </div>
                                        <div class="pt-4 flex items-center justify-between">
                                            <span class="text-lg font-bold text-[#176b98]"
                                                x-text="course.price + ' SAR'"></span>
                                            <a :href="course.url"
                                                class="px-4 py-2 bg-[#176b98D2] text-[#FEBE35] text-sm font-medium rounded-md hover:bg-[#176b98] transition">
                                                Subscribe Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <template x-if="filteredCourses.length === 0 && !isLoading">
                                <div class="col-span-full text-center py-12 text-gray-500">
                                    No courses match your filters.
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-footer />

    <script>
        function courseFilter() {
            return {
                // Filters
                search: '',
                level: '',
                selectedCategories: [],
                minPrice: 0,
                maxPrice: 500,

                // Data
                courses: {!! json_encode($coursesForJs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!},

                globalMaxPrice: 500,
                isLoading: false,

                init() {
                    if (this.courses.length > 0) {
                        this.globalMaxPrice = Math.max(...this.courses.map(c => c.price));
                        this.maxPrice = this.globalMaxPrice;
                    }

                    this.$watch('search', () => this.debouncedFilter());
                    this.$watch('level', () => this.debouncedFilter());
                    this.$watch('selectedCategories', () => this.debouncedFilter());
                    this.$watch('minPrice', () => this.debouncedFilter());
                    this.$watch('maxPrice', () => this.debouncedFilter());
                },

                debouncedFilter() {
                    clearTimeout(this.filterTimeout);
                    this.isLoading = true;
                    this.filterTimeout = setTimeout(() => {
                        this.isLoading = false;
                    }, 300);
                },

                get filteredCourses() {
                    return this.courses.filter(course => {
                        if (this.search && !course.title.toLowerCase().includes(this.search.toLowerCase())) {
                            return false;
                        }
                        if (this.level && course.level !== this.level) {
                            return false;
                        }
                        if (this.selectedCategories.length > 0 && !this.selectedCategories.includes(course
                                .category_name)) {
                            return false;
                        }
                        if (course.price < this.minPrice || course.price > this.maxPrice) {
                            return false;
                        }
                        return true;
                    });
                }
            };
        }
    </script>
</body>

</html>
