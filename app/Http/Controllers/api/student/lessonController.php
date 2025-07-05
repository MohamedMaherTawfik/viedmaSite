<?php

namespace App\Http\Controllers\api\student;

use App\Http\Controllers\Controller;
use App\Http\Requests\lessonRequest;
use App\Interfaces\LessonInterface;
use Illuminate\Http\Request;

class lessonController extends Controller
{
    use apiResponse;
    private $lessonRepository;

    public function __construct(LessonInterface $lessonInterface)
    {
        $this->lessonRepository = $lessonInterface;
    }

    public function allLessons()
    {
        $lessons = $this->lessonRepository->allLessons(request('id'));
        try {
            if (count($lessons) == 0) {
                return $this->noContent();
            }
            return $this->success($lessons, 'All lessons fetched Successflly');
        } catch (\Throwable $th) {
            return $this->serverError($th);
        }
    }

    /**
     * Display of a lesson details.s
     *
     */
    public function lessonDetails()
    {
        $data = $this->lessonRepository->getLesson(request('id'));
        try {
            if (!empty($data)) {
                return $this->success($data, __('messages.show_Message'));
            } else {
                return $this->notFound(__('messages.notFound_Message'));
            }
        } catch (\Throwable $th) {
            return $this->serverError($th->getMessage());
        }
    }

    public function createLesson(lessonRequest $request)
    {
        $fields = $request->validated();
        $fields['image'] = request()->file('image')->store('lessonsImage', 'public');
        $fields['video'] = request()->file('video')->store('lessonsVideo', 'public');
        $lesson = $this->lessonRepository->createLessonApi($fields, request('id'));
        return $this->success($lesson);
    }

    public function updateLesson()
    {
        $fields = request()->all();
        $lesson = $this->lessonRepository->updateLesson($fields, request('id'));
        return $this->success($lesson, 'lesson Updated Successfully');
    }

    public function deleteLesson()
    {
        $this->lessonRepository->deleteLesson(request('id'));
        return $this->noContent();
    }
}
