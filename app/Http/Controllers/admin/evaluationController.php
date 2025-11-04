<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\noteRequest;
use App\Models\graduationNotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class evaluationController extends Controller
{
    public function trainerEvaluations()
    {
        $reports = graduationNotes::where('user_id', Auth::user()->id)->get();
        return view('admin.evaluations.index', compact('reports'));
    }

    public function storeEvaluation(noteRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'accepted';
        graduationNotes::create($validated);
        return redirect()->back()->with('success', 'Evaluation submitted successfully.');
    }
}
