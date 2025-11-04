<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\reportRequest;
use App\Models\report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class reportController extends Controller
{
    public function createReport($slug, User $user)
    {
        return view('admin.reports.create', compact('user'));
    }

    public function storeReport(reportRequest $request)
    {
        $validated = $request->validated();
        report::create([
            'user_id' => Auth::user()->id,
            'report' => $validated['report'],
            'student_id' => $validated['user_id'],
        ]);

        return redirect()->back()->with('success', 'Report submitted successfully.');
    }
}