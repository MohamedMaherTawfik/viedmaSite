 @php
     use App\Models\Courses;
     $course = Courses::where('slug', request('slug'))->first();
 @endphp
 <x-layout title="لوحه تحكم المدرب ">

     <!-- Sidebar -->
     <x-trainer-sidebar />

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
                                 <td class="flex items-center gap-3">
                                     <!-- زر المشاهدة -->
                                     <a href="{{ route('trainer.lesson.show', $item) }}"
                                         class="inline-flex items-center gap-1 bg-green-500 hover:bg-green-600 text-white text-sm font-medium px-3 py-1.5 rounded-lg shadow transition duration-200">
                                         👁️ <span>مشاهدة</span>
                                     </a>

                                     <!-- فورم الحذف -->
                                     <form action="{{ route('trainer.lesson.destroy', $item) }}" method="POST"
                                         onsubmit="return confirm('هل أنت متأكد من حذف هذا الدرس؟');">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit"
                                             class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white text-sm font-medium px-3 py-1.5 rounded-lg shadow transition duration-200">
                                             🗑️ <span>حذف</span>
                                         </button>
                                     </form>
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
                             <th>اسم الطالب</th>
                             <th>الملف</th>
                             <th>ملاحظات التقييم</th>
                             <th>التقييم</th>
                             <th>التاريخ</th>
                             <th>الإجراء</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($uploads as $item)
                             <tr>

                                 <td>{{ $item->user->name }}</td>
                                 <td>
                                     <a href="{{ asset('storage/' . $item->file) }}"
                                         class="inline-block px-4 py-2 bg-yellow-500 text-white font-medium rounded-lg hover:bg-yellow-600 transition">
                                         Project File
                                     </a>
                                 </td>
                                 <td>{{ $item->feedback }}</td>
                                 <td>{{ $item->grade }}</td>
                                 <td>{{ $item->created_at }}</td>
                                 <td>
                                     <!-- الزر -->
                                     <button onclick="openModal('{{ $item->id }}')"
                                         class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                         <i class="fas fa-comment-dots mr-1"></i> Feedback
                                     </button>

                                     <!-- المودال -->
                                     <div id="feedbackModal-{{ $item->id }}"
                                         class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                                         <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-6 relative">
                                             <!-- إغلاق -->
                                             <button onclick="closeModal('{{ $item->id }}')"
                                                 class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl">&times;</button>

                                             <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">Add
                                                 Feedback</h2>

                                             <form action="{{ route('trainer.feedback', $item) }}" method="POST"
                                                 class="space-y-4">
                                                 @csrf

                                                 <!-- الحقل الأول -->
                                                 <div>
                                                     <label for="grade-{{ $item->id }}"
                                                         class="block text-sm font-medium text-gray-700 mb-1">Grade</label>
                                                     <input type="number" name="grade"
                                                         id="grade-{{ $item->id }}" required
                                                         class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                                 </div>

                                                 <!-- الحقل الثاني -->
                                                 <div>
                                                     <label for="feedback-{{ $item->id }}"
                                                         class="block text-sm font-medium text-gray-700 mb-1">Feedback</label>
                                                     <textarea name="feedback" id="feedback-{{ $item->id }}" rows="3" required
                                                         class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                                                 </div>

                                                 <!-- أزرار التحكم -->
                                                 <div class="flex justify-end space-x-2">
                                                     <button type="button" onclick="closeModal('{{ $item->id }}')"
                                                         class="px-3 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition">
                                                         Cancel
                                                     </button>
                                                     <button type="submit"
                                                         class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                                         Submit
                                                     </button>
                                                 </div>
                                             </form>
                                         </div>
                                     </div>

                                     <!-- سكربت فتح وغلق المودال -->
                                     <script>
                                         function openModal(id) {
                                             document.getElementById('feedbackModal-' + id).classList.remove('hidden');
                                         }

                                         function closeModal(id) {
                                             document.getElementById('feedbackModal-' + id).classList.add('hidden');
                                         }
                                     </script>
                                 </td>
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

                         <div class="flex items-center space-x-3">
                             <form action="{{ route('trainer.project.delete', $item) }}" method="POST"
                                 onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا المشروع؟');">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit"
                                     class="px-3 py-2 mr-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                     <i class="fas fa-trash-alt"></i>
                                 </button>
                             </form>
                         </div>

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
                             <th>الشهادة</th>
                             <th>تقييم</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($course->enrollments as $item)
                             <tr>
                                 <td>{{ $item->user->name }}</td>
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
