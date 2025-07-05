<?php

namespace App\Repository;

use App\Interfaces\GamesInterface;
use App\Models\games;

class GamesRepository implements GamesInterface
{
    public function allGames()
    {
        return games::all();
    }

    public function allGamesPaginated()
    {
        return games::paginate(10);
    }

    public function newGames()
    {
        return games::all()->reverse()->take(3);
    }

    public function getGame($id)
    {
        $data = games::find($id);
        return $data;
    }

    public function getGameBySlug($slug)
    {
        return games::where('slug', $slug)->first();
    }

    public function createGame($data)
    {
        $game = games::create($data);
        return $game;
    }

    public function updateGame($id, $data)
    {
        $data = games::find($id)->update($data);
        return $data;
    }

    public function deleteGame($id)
    {
        $data = games::findOrFail($id);
        $data->delete();
        return $data;
    }
}