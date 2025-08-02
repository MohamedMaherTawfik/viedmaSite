<x-layout title="لوحه تحكم المدرب ">

    <!-- Sidebar -->
    <x-trainer-sidebar />

    <!-- Wrapper for main content with flex column -->
    <div class="flex flex-col flex-1">

        <!-- Main Content -->
        <main class="p-6 flex-1">
            <x-teacher-header />

            <h1 class="text-2xl font-bold mb-6">لوحة تحكم المدرب</h1>
            <form action="{{ route('trainer.project.store', $course) }}" method="POST" enctype="multipart/form-data"
                class="max-w-md mx-auto mt-10 space-y-4 p-6 bg-white rounded-lg shadow-md">
                @csrf

                <!-- العنوان -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">العنوان</label>
                    <input type="text" name="title" id="title"
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-blue-200"
                        required>
                </div>

                <!-- الوصف -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">الوصف</label>
                    <textarea name="description" id="description" rows="3"
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-blue-200"
                        required></textarea>
                </div>

                <!-- الحالة -->
                <input type="hidden" name="status" value="نشط">


                <!-- الملف -->
                <div>
                    <label for="file" class="block text-sm font-medium text-gray-700">الملف</label>
                    <input type="file" name="file" id="file"
                        class="mt-1 block w-full text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                        required>
                </div>

                <!-- زر الإرسال -->
                <div class="text-center">
                    <button type="submit"
                        class="bg-blue-600 text-white text-sm px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none">إرسال</button>
                </div>
            </form>



        </main>

    </div>

</x-layout>
