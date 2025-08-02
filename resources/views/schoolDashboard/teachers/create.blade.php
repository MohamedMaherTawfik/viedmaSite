 @php
     use App\Models\School;
     $schools = School::all();
 @endphp
 <x-layout title="لوحه تحكم المدرسه ">

     <!-- Sidebar -->
     <x-teacher-sidebar />

     <!-- Wrapper for main content with flex column -->
     <div class="flex flex-col flex-1">

         <!-- Main Content -->
         <main class="p-6 flex-1">
             <x-teacher-header />
             <form action="{{ route('school.teachers.store', request('slug')) }}" method="POST"
                 class=" mt-10 mx-auto bg-white p-6 rounded-lg shadow-lg space-y-4">

                 @csrf
                 <!-- Name -->
                 <div>
                     <label class="block mb-1 text-gray-700">الاسم</label>
                     <input type="text" name="name"
                         class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                     @error('name')
                         <span class="text-red-500 text-sm">{{ $message }}</span>
                     @enderror
                 </div>

                 <!-- Email -->
                 <div>
                     <label class="block mb-1 text-gray-700">البريد الإلكتروني</label>
                     <input type="email" name="email"
                         class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                     @error('email')
                         <span class="text-red-500 text-sm">{{ $message }}</span>
                     @enderror
                 </div>

                 <!-- Password -->
                 <div>
                     <label class="block mb-1 text-gray-700">كلمة المرور</label>
                     <input type="password" name="password"
                         class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                     @error('password')
                         <span class="text-red-500 text-sm">{{ $message }}</span>
                     @enderror
                 </div>

                 <!-- Phone -->
                 <div>
                     <label class="block mb-1 text-gray-700">رقم الهاتف</label>
                     <input type="tel" name="phone"
                         class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                     @error('phone')
                         <span class="text-red-500 text-sm">{{ $message }}</span>
                     @enderror
                 </div>

                 <!-- School Dropdown -->

                 <div>
                     <label class="block mb-1 text-gray-700">المدرسة</label>
                     <select name="school_id"
                         class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                         <option value="">اختر المدرسة</option>
                         @foreach ($schools as $school)
                             <option value="{{ $school->id }}">{{ $school->name }}</option>
                         @endforeach
                     </select>
                     @error('school_id')
                         <span class="text-red-500 text-sm">{{ $message }}</span>
                     @enderror
                 </div>


                 <!-- Topic -->
                 <div>
                     <label class="block mb-1 text-gray-700">الماده</label>
                     <input type="text" name="topic"
                         class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                     @error('topic')
                         <span class="text-red-500 text-sm">{{ $message }}</span>
                     @enderror
                 </div>

                 <!-- Hidden Role -->
                 <input type="hidden" name="role" value="teacher">

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
