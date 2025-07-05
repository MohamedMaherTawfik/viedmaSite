<?php

namespace App\Repository;

use App\Interfaces\GamesCategoriesInterface;
use App\Models\gamesCategorey;

class GamesCategoreyRepository implements GamesCategoriesInterface
{

    public function getAllCategories()
    {
        return gamesCategorey::get();
    }

    public function getSingleCategorey($id)
    {
        return gamesCategorey::find($id);
    }

    public function getSingleCategoreyBySlug($slug)
    {
        gamesCategorey::where('slug', $slug)->first();
    }

    public function createCategorey($data)
    {
        $categorey = gamesCategorey::create($data);
        return $categorey;
    }

    public function deleteCategorey($id)
    {
        return gamescategorey::find($id)->delete();
    }
}