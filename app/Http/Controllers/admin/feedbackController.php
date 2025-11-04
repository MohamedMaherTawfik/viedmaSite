<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\assignment_submission;
use Illuminate\Http\Request;

class feedbackController extends Controller
{
    public function feedback(Request $request, assignment_submission $project)
    {
        $data = $request->except('_token');
        $project->update($data);
        return redirect()->back()->with('success', 'تم حفظ التقييم بنجاح');
    }
}
