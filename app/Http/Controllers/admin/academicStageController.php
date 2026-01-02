<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicStages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class academicStageController extends Controller
{
    public function index()
    {
        $academicStages = AcademicStages::all();
        return view('admin.academicStages.index', compact('academicStages'));
    }
    public function storeAcademicStage(Request $request)
    {
        $data = $request->except('_token');
        $data['slug'] = Str::slug($data['name']) . '-' . time();
        AcademicStages::create($data);
        return redirect()->route('admin.academicStages')->with('success', 'Academic Stage Added Successfully');
    }
    public function updateAcademicStage(Request $request, AcademicStages $id)
    {
        $data = $request->except('_token');
        $data['slug'] = Str::slug($data['name']) . '-' . time();
        $id->update($data);
        return redirect()->route('admin.academicStages')->with('success', 'Academic Stage Updated Successfully');
    }
    public function deleteAcademicStage(AcademicStages $id)
    {
        $id->delete();
        return redirect()->route('admin.academicStages')->with('success', 'Academic Stage Deleted Successfully');
    }


}