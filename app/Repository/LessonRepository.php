<?php

namespace App\Repository;

use App\Events\NewDataEvent;
use App\Interfaces\LessonInterface;
use App\Models\Courses;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;

class lessonRepository implements LessonInterface
{
    public function allLessons($id)
    {
        return Lesson::where('courses_id', $id)->paginate(10);
    }

    public function getLesson($id)
    {
        return Lesson::with('comments')->find($id);
    }

    public function createLesson($data, $id)
    {
        $lesson = Lesson::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'video_url' => $data['video_url'],
            'courses_id' => $id,
            'image' => $data['image'],
            'user_id' => Auth::user()->id,
            'slug' => str_replace(' ', '-', strtolower($data['title'])),
        ]);
        return $lesson;
    }
    public function createLessonApi($data, $id)
    {
        $lesson = Lesson::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'video_url' => $data['video'],
            'courses_id' => $id,
            'image' => $data['image'],
            'user_id' => Auth::guard('api')->user()->id,
            'slug' => str_replace(' ', '-', strtolower($data['title'])),
        ]);
        return $lesson;
    }

    public function updateLesson($data, $id)
    {
        $lesson = Lesson::find($id);
        $lesson->update($data);
        return $lesson;
    }

    public function deleteLesson($id)
    {
        $data = Lesson::find($id)->delete();
        return $data;
    }

    public function getLessonBySlug($slug)
    {
        return Lesson::where('slug', $slug)->first();
    }

}