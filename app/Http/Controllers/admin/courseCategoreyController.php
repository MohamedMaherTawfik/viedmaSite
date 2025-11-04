<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class courseCategoreyController extends Controller
{
    public function index()
    {
        $categories = categories::all();
        return view('admin.CourseCategorey.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['slug'] = Str::slug($data['name']) . '-' . time();
        categories::create($data);
        return redirect()->back()->with('success', 'Categorey created successfully');
    }

    public function update(Request $request, categories $category)
    {
        $data = $request->except('_token');
        $data['slug'] = Str::slug($data['name']) . '-' . time();
        $category->update($data);
        return redirect()->back()->with('success', 'Categorey updated successfully');
    }

    public function delete(categories $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Categorey deleted successfully');
    }
}
