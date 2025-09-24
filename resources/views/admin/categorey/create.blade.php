<x-layout title="إضافة كاتيجوري جديد">

    {{-- sidebar --}}
    <x-admin-sidebar />

    <div class="flex flex-col flex-1">
        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-admin-header />

            <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">إضافة كاتيجوري جديد</h2>

                <form action="{{ route('admin.store.Categorey') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-5">
                    @csrf

                    <!-- الاسم -->
                    <!-- الاسم -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">الاسم</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 block w-full rounded-lg border border-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            required>
                    </div>

                    <!-- الوصف -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">الوصف</label>
                        <textarea id="description" name="description" rows="3"
                            class="mt-1 block w-full rounded-lg border border-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            required></textarea>
                    </div>

                    <!-- الصورة -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">الصورة</label>
                        <input type="file" id="image" name="image"
                            class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4
                                      file:rounded-lg file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-blue-50 file:text-blue-700
                                      hover:file:bg-blue-100">
                    </div>

                    <!-- زرار -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 transition">
                            حفظ الكاتيجوري
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</x-layout>
