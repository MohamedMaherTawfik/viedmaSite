<?php

namespace App\Interfaces;

interface GamesInterface
{
    public function allGames();
    public function allGamesPaginated();
    public function newGames();
    public function getGame($id);
    public function getGameBySlug($slug);
    public function createGame($data);
    public function updateGame($id, $data);
    public function deleteGame($id);
}