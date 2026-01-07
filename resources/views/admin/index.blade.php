<x-layout title="{{ __('main.admin_dashboard') }}">

    {{-- sidebar --}}
    <x-admin-sidebar />

    <div class="flex flex-col flex-1">

        <x-messagesdata />
        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-admin-header />

            {{-- Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

                <div class="p-6 rounded-xl text-white shadow-lg" style="background-color: #176b98;">
                    <h3 class="text-lg font-bold mb-2">{{ __('main.schools_count') }}</h3>
                    <p class="text-3xl font-extrabold">{{ $schoolsCount ?? 0 }}</p>
                </div>

                <div class="p-6 rounded-xl text-white shadow-lg" style="background-color: #FEBE35;">
                    <h3 class="text-lg font-bold mb-2">{{ __('main.teachers_count') }}</h3>
                    <p class="text-3xl font-extrabold">{{ $teachersCount ?? 0 }}</p>
                </div>

                <div class="p-6 rounded-xl text-white shadow-lg" style="background-color: #75C151;">
                    <h3 class="text-lg font-bold mb-2">{{ __('main.trainers_count') }}</h3>
                    <p class="text-3xl font-extrabold">{{ $trainersCount ?? 0 }}</p>
                </div>

                <div class="p-6 rounded-xl text-white shadow-lg" style="background-color: #374151;">
                    <h3 class="text-lg font-bold mb-2">{{ __('main.students_count') }}</h3>
                    <p class="text-3xl font-extrabold">{{ $studentsCount ?? 0 }}</p>
                </div>

                <div class="p-6 rounded-xl text-white shadow-lg" style="background-color: purple;">
                    <h3 class="text-lg font-bold mb-2">{{ __('main.parents_count') }}</h3>
                    <p class="text-3xl font-extrabold">{{ $parentsCount ?? 0 }}</p>
                </div>

                <div class="p-6 rounded-xl text-white shadow-lg" style="background-color: teal;">
                    <h3 class="text-lg font-bold mb-2">{{ __('main.game_orders_count') }}</h3>
                    <p class="text-3xl font-extrabold">{{ $orders ?? 0 }}</p>
                </div>

            </div>

            {{-- Tables Section --}}
            <div class="mt-10 grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Users Table (Dark Blue bg / Yellow text) --}}
                <div class="rounded-xl shadow p-4" style="background-color:#084363">
                    <h3 class="text-lg font-bold mb-4" style="color:#FEBE35">
                        {{ __('main.latest_users') }}
                    </h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead style="color:#FEBE35">
                                <tr>
                                    <th class="px-4 py-2 text-center ">id</th>
                                    <th class="px-4 py-2 text-center ">{{ __('main.name') }}</th>
                                    <th class="px-4 py-2 text-center ">{{ __('main.role') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-yellow-300">
                                @forelse($users as $user)
                                    <tr class="hover:bg-blue-900/40">
                                        <td class="px-4 py-2 text-center text-yellow-200">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2 text-center font-medium text-yellow-200">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-4 py-2 text-center capitalize">
                                            <span class="px-2 py-1 rounded text-md text-black" style="color: #FEBE35">
                                                {{ $user->role }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-4 text-center text-yellow-300">
                                            {{ __('main.no_users') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Games Table (Yellow bg / Dark Blue text) --}}
                <div class="rounded-xl border border-gray-300 shadow p-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold" style="color:#176b98">
                            {{ __('main.latest_games') }}
                        </h3>
                        <a href="{{ route('admin.games.index') }}"
                            class="text-sm p-2 rounded font-medium
          transition-all duration-300 ease-in-out
          hover:scale-110 hover:px-4"
                            style="color:#FEBE35; background-color:#176b98;">
                            {{ __('main.view_all') }}
                        </a>

                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm" style="color:#176b98">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-center">id</th>
                                    <th class="px-4 py-2 text-center">{{ __('main.game_name') }}</th>
                                    <th class="px-4 py-2 text-center">{{ __('main.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-blue-300">
                                @forelse($games as $game)
                                    <tr class="hover:bg-yellow-300/40">
                                        <td class="px-4 py-2 text-center">{{ $loop->iteration }}</td>

                                        <td class="px-4 py-2 text-center font-medium">
                                            {{ $game->title }}
                                        </td>

                                        {{-- Actions --}}
                                        <td class="px-4 py-2 text-center">
                                            <div class="flex justify-center gap-2">

                                                {{-- Show --}}
                                                <a href="{{ route('admin.games.show', $game->id) }}"
                                                    class="p-2 rounded hover:bg-blue-100"
                                                    title="{{ __('main.show') }}">
                                                    👁️
                                                </a>

                                                {{-- Delete --}}
                                                <form action="{{ route('admin.games.delete', $game->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('{{ __('main.confirm_delete') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 rounded hover:bg-red-100"
                                                        title="{{ __('main.delete') }}">
                                                        🗑️
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-4 text-center text-blue-800">
                                            {{ __('main.no_games') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>

                {{-- Courses Table (Dark Blue bg / Yellow text) --}}
                <div class="rounded-xl shadow p-4" style="background-color:#084363">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold" style="color:#FEBE35">
                            {{ __('main.latest_courses') }}
                        </h3>
                        <a href="{{ route('admin.courses') }}" class="text-sm font-medium hover:underline"
                            style="color:#FEBE35">
                            {{ __('main.view_all') }}
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead style="color:#FEBE35">
                                <tr>
                                    <th class="px-4 py-2 text-center">ID</th>
                                    <th class="px-4 py-2 text-center">{{ __('main.course_name') }}</th>
                                    <th class="px-4 py-2 text-center">{{ __('main.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-yellow-300">
                                @forelse($courses as $course)
                                    <tr class="hover:bg-blue-900/40">
                                        <td class="px-4 py-2 text-center text-yellow-200">{{ $course->id }}</td>
                                        <td class="px-4 py-2 text-center font-medium text-yellow-200">
                                            {{ $course->title }}
                                        </td>

                                        {{-- Actions --}}
                                        <td class="px-4 py-2 text-center">
                                            <div class="flex justify-center gap-2">

                                                {{-- Show (لو الكورس ملك المستخدم) --}}
                                                @if ($course->user_id === auth()->id())
                                                    <a href="{{ route('admin.courses.me.show', $course->id) }}"
                                                        class="p-2 rounded hover:bg-blue-100 text-blue-800"
                                                        title="{{ __('main.show') }}">
                                                        👁️
                                                    </a>
                                                @endif

                                                {{-- Delete --}}
                                                <form action="{{ route('admin.courses.me.delete', $course->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('{{ __('main.confirm_delete') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="p-2 rounded hover:bg-red-100 text-red-600"
                                                        title="{{ __('main.delete') }}">
                                                        🗑️
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-4 text-center text-yellow-300">
                                            {{ __('main.no_courses') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>


        </main>

    </div>
</x-layout>
