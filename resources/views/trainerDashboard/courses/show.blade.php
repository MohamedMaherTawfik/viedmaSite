 @php
     use App\Models\Courses;
     $course = Courses::where('slug', request('slug'))->first();
 @endphp
 <x-layout title="لوحه تحكم المدرب ">

     <!-- Sidebar -->
     <x-trainer-sidebar />

     <!-- Wrapper for main content with flex column -->
     <div class="flex flex-col flex-1">

         <!-- Main Content -->
         <main class="p-6 flex-1 space-y-8">
             <h1 class="text-2xl font-bold mb-6">لوحة تحكم المدرب</h1>

             <!-- معلومات الدورة الأساسية -->
             <div class="bg-white rounded-xl shadow p-6 space-y-4">
                 <h2 class="text-xl font-bold">معلومات الدورة الأساسية</h2>
                 <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-center">
                     <div>
                         <p class="text-gray-500">اسم الدورة</p>
                         <p class="font-semibold">{{ $course->title }}</p>
                     </div>
                     <div>
                         <p class="text-gray-500">وصف الدورة</p>
                         <p class="text-sm">{{ \Illuminate\Support\Str::limit($course->description, 20, '...') }}</p>
                     </div>
                     <div>
                         <p class="text-gray-500">تاريخ البدء</p>
                         <p class="font-semibold">{{ $course->start_Date }}</p>
                     </div>
                     <div>
                         <p class="text-gray-500">المده</p>
                         <p class="font-semibold">{{ $course->duration }} ساعات</p>
                     </div>
                     <div>
                         <p class="text-gray-500">الحالة</p>
                         <p class="text-green-600 font-bold">{{ $course->status }}</p>
                     </div>
                     <div>
                         <p class="text-gray-500">المستوي</p>
                         <p class="text-green-600 font-bold">{{ $course->level }}</p>
                     </div>
                 </div>
             </div>

             <!-- محاور الدورة / جدول الدروس -->
             <div class="bg-white rounded-xl shadow p-6">
                 <h2 class="text-xl font-bold mb-4">محاور الدورة / جدول الدروس</h2>
                 <table class="w-full text-center table-auto border">
                     <thead>
                         <tr class="bg-gray-100">
                             <th>رقم الدرس</th>
                             <th class="py-2">المحور</th>
                             <th>الملف المرفق</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($course->lessons as $item)
                             <tr>
                                 <td>{{ $loop->iteration }}</td>
                                 <td>{{ $item->title }}</td>
                                 <td><a href="{{ $item->video_url }}" target="_blank" rel="noopener noreferrer"
                                         class="text-green-600 hover:underline">مشاهدة</a>
                                 </td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
                 <div class="mt-8">
                     <a href="{{ route('trainer.lesson.create', $course) }}"
                         class="mt-4 bg-blue-600 text-white py-2 px-4 rounded">+
                         إضافة درس</a>
                 </div>
             </div>

             <!-- مواعيد الجلسات التدريبية -->
             <div class="bg-white rounded-xl shadow p-6">
                 <h2 class="text-xl font-bold mb-4">مواعيد الجلسات التدريبية</h2>

                 <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                     @foreach ($course->sessionTime as $item)
                         <div class="bg-gray-50 p-4 rounded shadow">
                             <p><strong>Zoom Link</strong> - {{ $item->date }} </p>
                             <p class="text-green-600">- {{ $item->time }}</p>
                         </div>
                     @endforeach
                 </div>

                 <div class="mt-16">
                     <a href="{{ route('trainer.schedules.create', $course) }}"
                         class="inline-block bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                         إضافة موعد جديد
                     </a>
                 </div>
             </div>


             <!-- الملفات التدريبية المرفقة -->
             <div class="bg-white rounded-xl shadow p-6">
                 <h2 class="text-xl font-bold mb-4">الملفات التدريبية المرفقة من المتدربين</h2>
                 <table class="w-full text-center table-auto border">
                     <thead class="bg-gray-100">
                         <tr>
                             <th>اسم الملف</th>
                             <th>النوع</th>
                             <th>التاريخ</th>
                             <th>مرفوع بواسطة</th>
                             <th>الإجراء</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($uploads as $item)
                             <tr>
                                 <td>{{ $item->feedback }}</td>
                                 <td>{{ $item->file }}</td>
                                 <td>{{ $item->created_at }}</td>
                                 <td>{{ $item->user->name }}</td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>

             <!-- مشروع التخرج المطلوب -->
             <div class="bg-white rounded-xl shadow p-6">
                 <h2 class="text-xl font-bold mb-4">مشروع التخرج المطلوب</h2>

                 @foreach ($course->graduationProject as $item)
                     <div class="border rounded-lg bg-gray-50 p-4 mb-4 flex justify-between items-start">
                         <div>
                             <p><strong>عنوان المشروع: </strong>{{ $item->title }}</p>
                             <p class="text-sm text-gray-600"><strong>وصف المشروع: </strong> {{ $item->description }}
                             </p>
                             <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                 class="text-green-600 mt-2 inline-block">
                                 تحميل
                             </a>
                         </div>

                         <!-- زر الحذف -->
                         <form action="{{ route('trainer.project.delete', $item) }}" method="POST"
                             onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا المشروع؟');">
                             @csrf
                             @method('DELETE')
                             <button type="submit" class="text-red-600 hover:text-red-800 ml-4">
                                 <i class="fas fa-trash-alt text-lg"></i>
                             </button>
                         </form>
                     </div>
                 @endforeach

                 <div class="mt-10">
                     <a href="{{ route('trainer.project.create', $course) }}"
                         class="mt-4 bg-blue-600 text-white py-2 px-4 rounded">إضافة ملف جديد</a>
                 </div>
             </div>


             <!-- المتدربين المسجلين -->
             <div class="bg-white rounded-xl shadow p-6">
                 <h2 class="text-xl font-bold mb-4">المتدربين المسجلين</h2>
                 <table class="w-full text-center table-auto border">
                     <thead class="bg-gray-100">
                         <tr>
                             <th>الاسم</th>
                             <th>النسبة</th>
                             <th>الشهادة</th>
                             <th>تقييم</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($course->enrollments as $item)
                             <tr>
                                 <td>{{ $item->user->name }}</td>
                                 <td>{{ $item->user->report }}</td>
                                 <td>
                                     @if ($item->user && $item->user->reviews && $item->user->reviews->file)
                                         <a href="{{ $item->user->reviews->file }}" class="text-green-600">تحميل</a>
                                     @else
                                         <span class="text-gray-500">لا يوجد ملف</span>
                                     @endif
                                 </td>
                                 <td>
                                     <a href="{{ route('trainer.report.create', ['slug' => request('slug'), 'user' => $item->user]) }}"
                                         class="text-red-600 font-bold">اضافه</a>
                                 </td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
         </main>

     </div>

 </x-layout>
