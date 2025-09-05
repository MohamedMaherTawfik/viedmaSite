<?php

namespace App\Http\Controllers\api\store;

use App\Http\Controllers\Controller;
use App\Http\Requests\GameRequest;
use App\Models\games;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GamesController extends Controller
{
    use apiResponse;
    public function allGames()
    {
        $games = games::paginate(10);
        return $this->success($games, 'All Games Fetched Successfully');
    }

    public function showGame()
    {
        $game = games::find(request('id'));
        try {
            if (!$game) {
                return $this->notFound('Game Not Found');
            }
            return $this->success($game, 'Game Fetched Successfully');
        } catch (\Throwable $th) {
            return $this->serverError($th->getMessage());
        }
    }

    public function createGames(GameRequest $request)
    {
        $game = $request->validated();
        $game['user_id'] = auth()->user()->id;
        $game['slug'] = Str::slug($game['title']) . '-' . time();
        if ($request->hasFile('cover_image')) {
            $game['cover_image'] = $request->file('cover_image')->store('photos', 'public');
        }
        games::create($game);
        return $this->created($game, 'Game Created Successfully');
    }

    public function updateGame(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']) . '-' . time();
        $data['user_id'] = auth()->user()->id;
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('photos', 'public');
        }
        $game = games::find(request('id'));
        $game->update($data);
        return $this->success($game, 'Game Updated Successfully');
    }
    public function deleteGame()
    {
        games::find(request('id'))->delete();
        return $this->noContent();
    }

    public function searchforGame(Request $request)
    {
        $query = Games::query();
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        $games = $query->get();
        if ($games->isEmpty()) {
            return $this->noContent();
        }
        return $this->success($games, 'Games Fetched Successfully');
    }

}