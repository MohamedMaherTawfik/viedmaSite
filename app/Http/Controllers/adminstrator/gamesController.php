<?php

namespace App\Http\Controllers\adminstrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\GameRequest;
use App\Models\games;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class gamesController extends Controller
{
    public function games()
    {
        $games = games::all();
        return view('admin.games.index', compact('games'));
    }

    public function createGame()
    {
        return view('admin.games.create');
    }

    public function storeGame(GameRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('photos', 'public');
        }
        games::create($validated);
        return redirect()->route('admin.games.index')->with('success', 'Game created successfully');

    }

    public function showGame(games $game)
    {
        return view('admin.games.show', compact('game'));
    }

    public function deleteGame(games $game)
    {
        $game->delete();
        return redirect()->route('admin.games.index')->with('success', 'Game deleted successfully');
    }
}
