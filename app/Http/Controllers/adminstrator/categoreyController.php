<?php

namespace App\Http\Controllers\adminstrator;

use App\Http\Controllers\Controller;
use App\Models\GameCategorey;
use App\Models\gamesCategorey;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class categoreyController extends Controller
{
    public function categorey()
    {
        $categories = gamesCategorey::all();
        return view('admin.categorey.index', compact('categories'));
    }

    public function createCategorey()
    {
        return view('admin.categorey.create');
    }

    public function storeCategorey(Request $request)
    {
        $data = $request->except('_token');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('photos', 'public');
        }
        dd($data);
        $data['slug'] = Str::slug($data['name']) . '-' . time();
        gamesCategorey::create($data);
        return redirect()->route('admin.categorey')->with('success', 'Categorey created successfully');
    }


    public function editCategorey(GameCategorey $categorey)
    {
        return view('admin.categorey.edit', compact('categorey'));
    }

    public function updateCategorey(Request $request, GameCategorey $categorey)
    {
        $data = $request->except('_token');
        $categorey->update($data);
        return redirect()->route('admin.categorey')->with('success', 'Categorey updated successfully');
    }

    public function deleteCategorey(GameCategorey $categorey)
    {
        $categorey->delete();
        return redirect()->route('admin.categorey')->with('success', 'Categorey deleted successfully');
    }
}