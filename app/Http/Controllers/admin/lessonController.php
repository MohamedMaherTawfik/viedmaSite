<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\lessonRequest;
use App\Jobs\UploadLessonToYouTubeJob;
use App\Models\Courses;
use App\Models\lesson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class lessonController extends Controller
{
    public function createLesson(Courses $course)
    {
        return view('admin.lesson.create', compact('course'));
    }

    public function storeLesson(lessonRequest $request, Courses $course)
    {
        $validated = $request->validated();
        $validated['courses_id'] = $course->id;
        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('Lessons', 'public');
        }
        $validated['video_url'] = $request->file('video_url')->store('videos', 'public');
        lesson::create($validated);

        return redirect()
            ->route('admin.courses.me.show', $course)
            ->with('success', 'سيتم عرض الفيديو بمجرد الانتهاء من الرفع');
    }

    public function showLesson(lesson $course)
    {
        return view('admin.lesson.show', compact('course'));
    }

    public function destroyLesson(lesson $course)
    {
        $course->delete();
        return redirect()->back()->with('success', 'تم حذف الدرس بنجاح');
    }
}