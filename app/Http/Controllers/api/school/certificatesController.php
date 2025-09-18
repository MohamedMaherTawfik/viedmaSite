<?php

namespace App\Http\Controllers\api\school;

use App\Http\Controllers\api\store\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class certificatesController extends Controller
{
    use ApiResponse;

    public function allCertificates()
    {
        $certificates = certificate::where('courses_id', request('id'))->where('teacher_id', auth()->user()->id)->get();
        return $this->success($certificates, 'all certificates');
    }

    public function singleCertificate()
    {
        $certificate = certificate::find(request('id'));
        return $this->success($certificate, 'single certificate');
    }

    public function createCertificate(Request $request)
    {
        $data = $request->all();
        $data['teacher_id'] = auth()->user()->id;
        $data['slug'] = Str::slug($data['certificate']) . '-' . time();
        $data['courses_id'] = request('id');
        try {
            if (isset($data['file'])) {
                $data['file'] = $data['file']->store('certificates', 'public');
            }
            $certificate = certificate::create($data);
            return $this->success($certificate, 'certificate created');
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }

    public function deleteCertificate()
    {
        $certificate = certificate::find(request('id'));
        $certificate->delete();
        return $this->success($certificate, 'certificate deleted');
    }
}
