<?php

namespace App\Interfaces;

interface GamesCategoriesInterface
{
    public function createCategorey($data);
    public function getAllCategories();
    public function getSingleCategorey($id);
    public function getSingleCategoreyBySlug($slug);
    public function deleteCategorey($id);
}
