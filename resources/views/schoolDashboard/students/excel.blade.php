 @php
     use App\Models\school;
     $schools = school::all();
 @endphp
 <x-layout title="لوحه تحكم المدرسه ">
     @php
         $slug = request('slug');
     @endphp
     <!-- Sidebar -->
     <x-teacher-sidebar />

     <!-- Wrapper for main content with flex column -->
     <div class="flex flex-col flex-1">
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

         <!-- Main Content -->
         <main class="p-6 flex-1">
             <x-school-header />
             <!-- Form to upload Excel file -->
             <form action="{{ route('excel.upload', ['slug' => $slug]) }}" method="POST" enctype="multipart/form-data"
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
