<x-layout title="لوحه تحكم المدرسه ">

    <!-- Sidebar -->
    <x-teacher-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-teacher-header />
            {{-- Success Message --}}
            @if (session('success'))
                <div class="p-4 mb-4 text-green-800 bg-green-200 border border-green-300 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Fail Message --}}
            @if (session('fail'))
                <div class="p-4 mb-4 text-red-800 bg-red-200 border border-red-300 rounded">
                    {{ session('fail') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="p-4 mb-4 text-red-800 bg-red-100 border border-red-300 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Section -->
            <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">
                <h2 class="text-2xl font-bold mb-4">Add New Item</h2>

                <form action="" method="POST">
                    @csrf

                    <!-- Message Field -->
                    <div class="mb-4">
                        <label for="message" class="block font-medium mb-1">message</label>
                        <input type="text" id="message" name="message"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-blue-400"
                            required>
                    </div>
                </form>
            </div>
        </main>

    </div>

</x-layout>
