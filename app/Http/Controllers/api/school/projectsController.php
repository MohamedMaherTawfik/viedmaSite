<?php

namespace App\Http\Controllers\api\school;

use App\Http\Controllers\api\store\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\graduationProject;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class projectsController extends Controller
{
    use ApiResponse;

    public function allProjects()
    {
        $projects = graduationProject::where('courses_id', request('id'))->where('teacher_id', auth()->user()->id)->get();
        return $this->success($projects, 'all projects');
    }

    public function singleProject()
    {
        $project = graduationProject::find(request('id'));
        return $this->success($project, 'single project');
    }

    public function createProject(Request $request)
    {
        $data = $request->all();
        $data['teacher_id'] = auth()->user()->id;
        $data['courses_id'] = request('id');
        $data['slug'] = Str::slug($data['title']) . '-' . time();
        try {
            if (isset($data['file'])) {
                $data['file'] = $data['file']->store('projects', 'public');
            }
            $project = graduationProject::create($data);
            return $this->success($project, 'project created');
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }

    }

    public function deleteProject()
    {
        $project = graduationProject::find(request('id'));
        $project->delete();
        return $this->success($project, 'project deleted');
    }

}