<x-layout title="{{ __('main.student_details') }}">
    <!-- Sidebar -->
    <x-trainer-sidebar />

    <div class="flex flex-col flex-1">
    <main class="p-6 flex-1">
        <x-teacher-header />

        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            {{ __('main.student_details') }}
        </h2>

        <div class="space-y-6">
            <!-- معلومات الطالب -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('main.personal_info') }}</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <p class="text-gray-500 text-sm">{{ __('main.student_name') }}</p>
                        <p class="font-semibold text-gray-800 mt-1">{{ $student->me->name ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">{{ __('main.email') }}</p>
                        <p class="font-semibold text-gray-800 mt-1">{{ $student->me->email ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">{{ __('main.national_id') }}</p>
                        <p class="font-semibold text-gray-800 mt-1">{{ $student->national_id ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">{{ __('main.nationality') }}</p>
                        <p class="font-semibold text-gray-800 mt-1">{{ $student->nationallity ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">{{ __('main.parent_phone') }}</p>
                        <p class="font-semibold text-gray-800 mt-1">{{ $student->parent_phone ?? __('main.not_available') }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">{{ __('main.academic_stage') }}</p>
                        <p class="font-semibold text-gray-800 mt-1">{{ $student->Academic_stage ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- أزرار التحكم -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('main.student_actions') }}</h3>

                <div class="flex flex-wrap gap-4">
                    <button type="button"
                            onclick="openBehaviorModal()"
                            class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg font-medium transition duration-200 flex items-center gap-2">
                        {{ __('main.behavior') }}
                    </button>

                    <button type="button"
                            onclick="openActivityModal()"
                            class="px-6 py-3 bg-green-500 hover:bg-green-600 text-white rounded-lg font-medium transition duration-200 flex items-center gap-2">
                        {{ __('main.activity') }}
                    </button>

                    <button type="button"
                            onclick="openInteractionModal()"
                            class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-medium transition duration-200 flex items-center gap-2">
                        {{ __('main.interaction') }}
                    </button>
                </div>
            </div>
        </div>
    </main>
</div>


    <!-- Modal for Behavior -->
    <div id="behaviorModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">
                    {{ __('main.behavior') }}
                </h3>

                <form id="behaviorForm">
                    <div class="mb-4">
                        <label for="behaviorType" class="block text-sm font-medium text-gray-700 mb-2">
                            نوع السلوك
                        </label>
                        <select id="behaviorType" name="behavior_type"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <option value="positive">إيجابي</option>
                            <option value="negative">سلبي</option>
                            <option value="neutral">محايد</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="behaviorDescription" class="block text-sm font-medium text-gray-700 mb-2">
                            الوصف
                        </label>
                        <textarea id="behaviorDescription" name="description" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                placeholder="أدخل وصف السلوك..."></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="behaviorDate" class="block text-sm font-medium text-gray-700 mb-2">
                            التاريخ
                        </label>
                        <input type="date" id="behaviorDate" name="date"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    </div>
                </form>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button"
                            onclick="closeBehaviorModal()"
                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md font-medium">
                        إلغاء
                    </button>
                    <button type="button"
                            onclick="submitBehavior()"
                            class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md font-medium">
                        حفظ
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Activity -->
    <div id="activityModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">
                    {{ __('main.activity') }}
                </h3>

                <form id="activityForm">
                    <div class="mb-4">
                        <label for="activityType" class="block text-sm font-medium text-gray-700 mb-2">
                            نوع النشاط
                        </label>
                        <select id="activityType" name="activity_type"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="academic">أكاديمي</option>
                            <option value="sports">رياضي</option>
                            <option value="artistic">فني</option>
                            <option value="social">اجتماعي</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="activityDescription" class="block text-sm font-medium text-gray-700 mb-2">
                            تفاصيل النشاط
                        </label>
                        <textarea id="activityDescription" name="description" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                                placeholder="أدخل تفاصيل النشاط..."></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="activityDate" class="block text-sm font-medium text-gray-700 mb-2">
                                التاريخ
                            </label>
                            <input type="date" id="activityDate" name="date"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <div>
                            <label for="activityScore" class="block text-sm font-medium text-gray-700 mb-2">
                                التقييم
                            </label>
                            <input type="number" id="activityScore" name="score" min="0" max="100"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                                   placeholder="0-100">
                        </div>
                    </div>
                </form>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button"
                            onclick="closeActivityModal()"
                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md font-medium">
                        إلغاء
                    </button>
                    <button type="button"
                            onclick="submitActivity()"
                            class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md font-medium">
                        حفظ
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Interaction -->
    <div id="interactionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">
                    {{ __('main.interaction') }}
                </h3>

                <form id="interactionForm">
                    <div class="mb-4">
                        <label for="interactionType" class="block text-sm font-medium text-gray-700 mb-2">
                            نوع التفاعل
                        </label>
                        <select id="interactionType" name="interaction_type"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="classroom">فصل دراسي</option>
                            <option value="online">تفاعل إلكتروني</option>
                            <option value="group">تفاعل جماعي</option>
                            <option value="one_on_one">تفاعل فردي</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="interactionNotes" class="block text-sm font-medium text-gray-700 mb-2">
                            ملاحظات
                        </label>
                        <textarea id="interactionNotes" name="notes" rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="أدخل ملاحظات التفاعل..."></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            مستوى التفاعل
                        </label>
                        <div class="flex items-center space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="interaction_level" value="low"
                                       class="text-blue-600 focus:ring-blue-500">
                                <span class="mr-2">منخفض</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="interaction_level" value="medium"
                                       class="text-blue-600 focus:ring-blue-500">
                                <span class="mr-2">متوسط</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="interaction_level" value="high"
                                       class="text-blue-600 focus:ring-blue-500">
                                <span class="mr-2">مرتفع</span>
                            </label>
                        </div>
                    </div>
                </form>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button"
                            onclick="closeInteractionModal()"
                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md font-medium">
                        إلغاء
                    </button>
                    <button type="button"
                            onclick="submitInteraction()"
                            class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md font-medium">
                        حفظ
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Functions for Behavior Modal
        function openBehaviorModal() {
            document.getElementById('behaviorModal').classList.remove('hidden');
            document.getElementById('behaviorDate').valueAsDate = new Date();
        }

        function closeBehaviorModal() {
            document.getElementById('behaviorModal').classList.add('hidden');
            document.getElementById('behaviorForm').reset();
        }

        function submitBehavior() {
            // Here you would typically submit the form via AJAX
            const formData = new FormData(document.getElementById('behaviorForm'));
            console.log('Behavior data:', Object.fromEntries(formData));
            closeBehaviorModal();
            alert('تم حفظ بيانات السلوك بنجاح');
        }

        // Functions for Activity Modal
        function openActivityModal() {
            document.getElementById('activityModal').classList.remove('hidden');
            document.getElementById('activityDate').valueAsDate = new Date();
        }

        function closeActivityModal() {
            document.getElementById('activityModal').classList.add('hidden');
            document.getElementById('activityForm').reset();
        }

        function submitActivity() {
            const formData = new FormData(document.getElementById('activityForm'));
            console.log('Activity data:', Object.fromEntries(formData));
            closeActivityModal();
            alert('تم حفظ بيانات النشاط بنجاح');
        }

        // Functions for Interaction Modal
        function openInteractionModal() {
            document.getElementById('interactionModal').classList.remove('hidden');
        }

        function closeInteractionModal() {
            document.getElementById('interactionModal').classList.add('hidden');
            document.getElementById('interactionForm').reset();
        }

        function submitInteraction() {
            const formData = new FormData(document.getElementById('interactionForm'));
            console.log('Interaction data:', Object.fromEntries(formData));
            closeInteractionModal();
            alert('تم حفظ بيانات التفاعل بنجاح');
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const behaviorModal = document.getElementById('behaviorModal');
            const activityModal = document.getElementById('activityModal');
            const interactionModal = document.getElementById('interactionModal');

            if (event.target === behaviorModal) {
                closeBehaviorModal();
            }
            if (event.target === activityModal) {
                closeActivityModal();
            }
            if (event.target === interactionModal) {
                closeInteractionModal();
            }
        }
    </script>
</x-layout>
