<?php

namespace App\Http\Controllers\api\student;

use App\Http\Controllers\api\student\apiResponse;
use App\Http\Controllers\Controller;
use App\Interfaces\CategoryInterface;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class categoreyController extends Controller
{
    use apiResponse;
    private $categoryRepository;
    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->categoryRepository = $categoryInterface;
    }

    public function allCategories()
    {
        $categories = $this->categoryRepository->getAllCategories();
        try {
            if (count($categories) == 0) {
                return $this->noContent();
            }
            return $this->success($categories, 'All categories Fetched Successfully');
        } catch (\Throwable $th) {
            return $this->serverError($th);
        }
    }

    public function singleCategorey()
    {
        $category = $this->categoryRepository->getCategoryById(request('id'));
        try {
            if (!$category) {
                return $this->notFound('Categorey not found');
            }
            return $this->success($category, 'categorey Fetched Successfully');
        } catch (\Throwable $th) {
            $this->serverError($th);
        }
    }

    public function createCategory(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|min:1|max:50|unique:categories'
        ]);
        $fields['slug'] = Str::slug($fields['name']);

        $categorey = $this->categoryRepository->createCategory($fields);
        if (!$categorey) {
            return $this->serverError('not created');
        }
        return $this->success($categorey, 'Categorey Created Successfully');
    }

    public function updateCategory(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|min:1|max:50|unique:categories'
        ]);
        $fields['slug'] = Str::slug($fields['name']);
        $category = $this->categoryRepository->updateCategory(request('id'), $fields);
        if (!$category) {
            return $this->serverError('not Updated');
        }
        return $this->success($category, 'Categorey Updated Successfully');
    }

    public function deleteCategory()
    {
        $category = $this->categoryRepository->deleteCategory(request('id'));
        if (!$category) {
            return $this->serverError('ctegorey not deleted');
        }
        return $this->noContent();
    }
}