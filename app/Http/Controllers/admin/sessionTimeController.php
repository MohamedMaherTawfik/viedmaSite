<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\sessionTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class sessionTimeController extends Controller
{
    public function trainerSchedules()
    {
        $sessionTimes = sessionTime::where('user_id', Auth::user()->id)->get();
        return view('admin.schedules.index', compact('sessionTimes'));
    }

    public function createSessionTime()
    {
        $courses = Courses::where('user_id', Auth::user()->id)->get();
        return view('admin.schedules.create', compact('courses'));
    }

    public function storeSessionTime(Request $request, )
    {
        $validated = $request->validate([
            'courses_id' => 'required',
            'date' => 'required',
            'time' => 'required'
        ]);
        $validated['user_id'] = Auth::user()->id;

        SessionTime::create($validated);

        return redirect()->route('trainer.schedules', )->with('success', 'تم إضافة الموعد بنجاح');
    }
    public function editSessionTime(SessionTime $sessionTime)
    {
        return view('admin.schedules.edit', compact('sessionTime'));
    }

    public function updateSessionTime(Request $request, SessionTime $sessionTime)
    {
        $validated = $request->validate([
            'date' => 'nullable',
            'time' => 'nullable'
        ]);
        $sessionTime->update($validated);
        return redirect()->route('trainer.schedules')->with('success', 'تم تعديل الموعد بنجاح');
    }

    public function deleteSessionTime(SessionTime $sessionTime)
    {
        $sessionTime->delete();
        return redirect()->route('trainer.schedules')->with('success', 'تم حذف الموعد بنجاح');
    }
}
