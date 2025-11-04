<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\projectRequest;
use App\Models\assignment_submission;
use App\Models\Courses;
use App\Models\graduationProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class projectController extends Controller
{
    public function createProject(Courses $course)
    {
        return view('admin.projects.create', compact('course'));
    }

    public function storeProject(projectRequest $request, Courses $course)
    {
        $validated = $request->validated();
        $validated['teacher_id'] = Auth::id();
        $validated['courses_id'] = $course->id;
        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('Projects', 'public');
        }
        graduationProject::create($validated);
        return redirect()->route('admin.courses.me.show', $course->id)->with('Project Uploaded Successfully');
    }

    public function deleteProject(graduationProject $graduationProject)
    {
        $graduationProject->delete();
        return redirect()->back()->with('success', 'Project deleted successfully.');
    }

    public function trainerProjects()
    {
        $graduationProject = graduationProject::where('teacher_id', Auth::user()->id)->pluck('id');
        $assignments = assignment_submission::whereIn('graduation_project_id', $graduationProject)->get();
        return view('admin.projects.index', compact('assignments'));
    }

    public function allProjects()
    {
        $assignments = assignment_submission::where('user_id', auth()->id())->with('notes')->get();
        return view('admin.projects.index', compact('assignments'));
    }
}
