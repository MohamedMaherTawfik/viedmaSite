 @php
     use App\Models\School;
     $schools = School::all();
 @endphp
 <x-layout>
     <!-- Sidebar -->
     <x-school-sidebar />

     <!-- Wrapper for main content with flex column -->
     <div class="flex flex-col flex-1">

         <!-- Main Content -->
         <main class="p-6 flex-1">
             <x-school-header />
             <!-- Form to upload Excel file -->
             <form action="{{ route('teacher.excel.upload') }}" method="POST" enctype="multipart/form-data"
                 class="bg-white p-6 rounded shadow-md w-full max-w-md mx-auto mt-6">
                 @csrf
                 <label class="block mb-2 text-sm font-medium text-gray-700">اختر ملف Excel:</label>
                 <input type="file" name="excel_file" accept=".xlsx,.xls" required
                     class="block w-full text-sm text-gray-700 border border-gray-300 rounded px-3 py-2 mb-4">
                 <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">رفع
                     الملف</button>
             </form>
         </main>
     </div>

 </x-layout>
