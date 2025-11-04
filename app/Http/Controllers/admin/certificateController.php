<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\certificateRequest;
use App\Models\certificate;
use App\Models\Enrollments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class certificateController extends Controller
{
    public function trainerCertificates()
    {
        $courses = Auth::user()->course->pluck('id');
        $enrollments = Enrollments::whereIn('courses_id', $courses)->get();
        $certificates = certificate::where('user_id', Auth::user()->id)->get();
        return view('admin.certificate.index', compact('certificates', 'enrollments'));
    }

    public function storeCertificate(certificateRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['certificate']) . '-' . time();
        $validated['description'] = 'no description';
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('certificates', 'public');
        }
        certificate::create($validated);
        return redirect()->back()->with('success', 'Certificate uploaded successfully.');
    }
}