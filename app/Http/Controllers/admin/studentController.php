<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\adminRequest;
use App\Models\AcademicStages;
use App\Models\school;
use App\Models\student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\SimpleExcel\SimpleExcelReader;

class studentController extends Controller
{
    public function allStudents()
    {
        $students = student::with('me')->get();
        return view('admin.student.index', compact('students'));
    }

    // public function allTeachers()
    // {
    //     $students = User::where('role', 'trainer')->get();
    //     return view('admin.student.teachers', compact('students'));
    // }


    public function createStudent()
    {
        $academicStages = AcademicStages::all();
        return view('admin.student.create', compact('academicStages'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function storeStudent(adminRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = Str::slug($validatedData['name']);
        $user = User::create([
            'name' => $validatedData['name'] ?? 'null',
            'email' => $validatedData['email'] ?? 'null',
            'role' => 'user',
            'password' => bcrypt($validatedData['password']) ?? 'null',
            'school_id' => $validatedData['school_id'] ?? 'null',
        ]);
        student::create([
            'me_id' => $user->id,
            'name' => $validatedData['name'] ?? 'null',
            'national_id' => $validatedData['national_id'] ?? 'null',
            'nationallity' => $validatedData['nationallity'] ?? 'null',
            'academic_stages_id' => $validatedData['academic_stages_id'] ?? 'null',
            'school_id' => $validatedData['school_id'] ?? 'null',
            'slug' => $validatedData['slug'] ?? 'null',
        ]);
        return redirect()->route('admin.students')->with('success', 'Student created successfully.');
    }

    public function ExcelStudent()
    {
        return view('admin.student.excel');
    }
    /**
     * Upload Excel file and process it.
     */

    public function uploadExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        // احفظ الملف يدويًا
        $file = $request->file('excel_file');
        $savePath = storage_path('app/temp/students.xlsx');
        $file->move(storage_path('app/temp'), 'students.xlsx');

        $realPath = realpath($savePath); // Get absolute path

        if (!file_exists($realPath)) {
            return back()->withErrors(['msg' => 'الملف لم يتم حفظه بشكل صحيح.']);
        }

        SimpleExcelReader::create($realPath)
            ->getRows()
            ->each(function (array $row) use ($request) {

                $user = User::create([
                    'name' => $row['name'],
                    'email' => $row['name'] . '@gmail.com',
                    'password' => bcrypt('name'),
                ]);
                Student::create([
                    'name' => $row['name'],
                    'national_id' => $row['national_id'],
                    'nationallity' => $row['nationallity'],
                    'Academic_stage' => $row['Academic_stage'],
                    'me_id' => $user->id,
                    'slug' => Str::slug($row['name']) . '-' . time(),
                ]);
            });

        return redirect()->route('admin.students')->with('success', 'Excel file uploaded and students created successfully.');
    }

    public function editStudent(student $student)
    {
        return view('admin.student.edit', compact('student'));
    }

    public function updateStudent(student $student)
    {
        $data = request()->except('_token');
        $user = User::where('id', $student->me_id)->first();
        $user->update([
            'name' => $data['name'] ?? '-',
            'email' => $data['email'] ?? '-',
            'school_id' => $data['school_id'] ?? null,
        ]);
        $student->update([
            'school_id' => $data['school_id'],
            'name' => $data['name'],
            'national_id' => $data['national_id'],
            'nationallity' => $data['nationallity'],
            'Academic_stage' => $data['Academic_stage'],
            'slug' => Str::slug($data['name']) . '-' . time(),
        ]);
        return redirect()->route('admin.students')->with('success', 'Student updated successfully.');
    }
    public function deleteStudent(student $student)
    {
        $student->delete();
        user::where('id', $student->me_id)->delete();
        return redirect()->back()->with('success', 'Student deleted successfully.');
    }

    public function linkParent(student $name)
    {
        $parents = User::where('role', 'parent')->get();
        return view('admin.student.linkParent', compact('name', 'parents'));
    }

    public function linkParentStore(student $name)
    {
        $parent = User::where('name', request('parent'))->first();
        if (!$name || !$parent) {
            return redirect()->back()->with('error', 'User or Student not found.');
        }
        $name->user_id = $parent->id;
        $name->save();
        return redirect()->route('admin.students')->with('success', 'Parent linked to student successfully.');
    }
}
