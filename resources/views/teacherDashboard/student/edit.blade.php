 @php
     use App\Models\School;
     $schools = School::all();
 @endphp
 <x-layout title="لوحه تحكم المعلم ">
     <!-- Sidebar -->
     <x-school-sidebar />

     <!-- Wrapper for main content with flex column -->
     <div class="flex flex-col flex-1">

         <!-- Main Content -->
         <main class="p-6 flex-1">
             <x-school-header />
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

             <form action="{{ route('teacher.student.update', $student) }}" method="POST"
                 class="mt-10 mx-auto bg-white p-6 rounded-lg shadow-lg space-y-4">
                 @csrf

                 <!-- Name -->
                 <div>
                     <label class="block mb-1 text-gray-700">الاسم</label>
                     <input type="text" name="name"
                         class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                         value="{{ $student->name }}">

                     @error('name')
                         <span class="text-red-500 text-sm">{{ $message }}</span>
                     @enderror
                 </div>

                 <!-- National ID -->
                 <div>
                     <label class="block mb-1 text-gray-700">الرقم القومي</label>
                     <input type="text" name="national_id"
                         class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                         value="{{ $student->national_id }}">
                     @error('national_id')
                         <span class="text-red-500 text-sm">{{ $message }}</span>
                     @enderror
                 </div>

                 <!-- Academic Stage -->
                 <div>
                     <label class="block mb-1 text-gray-700">المرحلة الدراسية</label>
                     <input type="text" name="Academic_stage"
                         class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                         value="{{ $student->Academic_stage }}">
                     @error('Academic_stage')
                         <span class="text-red-500 text-sm">{{ $message }}</span>
                     @enderror
                 </div>

                 <!-- Nationality -->
                 <div>
                     <label class="block mb-1 text-gray-700">الجنسية</label>
                     <input type="text" name="nationallity"
                         class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                         value="{{ $student->nationallity }}">
                     @error('nationallity')
                         <span class="text-red-500 text-sm">{{ $message }}</span>
                     @enderror
                 </div>

                 <!-- School Dropdown -->
                 <div>
                     <label class="block mb-1 text-gray-700">المدرسة</label>
                     <select name="school_id"
                         class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                         <option value="{{ $student->school->id }}">اختر المدرسة</option>
                         @foreach ($schools as $school)
                             <option value="{{ $school->id }}">{{ $school->name }}</option>
                         @endforeach
                     </select>
                     @error('school_id')
                         <span class="text-red-500 text-sm">{{ $message }}</span>
                     @enderror
                 </div>



                 <!-- Submit Button -->
                 <div>
                     <button type="submit"
                         class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                         إرسال
                     </button>
                 </div>
             </form>

             @if ($errors->any())
                 <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative space-y-2"
                     role="alert">
                     <strong class="font-bold">حدثت الأخطاء التالية:</strong>
                     <ul class="list-disc list-inside">
                         @foreach ($errors->all() as $error)
                             <li>{{ $error }}</li>
                         @endforeach
                     </ul>
                 </div>
             @endif
         </main>
     </div>

 </x-layout>
