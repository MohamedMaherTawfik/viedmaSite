<?php

namespace App\Http\Controllers\api\school;

use App\Http\Controllers\api\store\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\achievmentsUsers;
use Illuminate\Http\Request;

class achievementController extends Controller
{
    use ApiResponse;
    public function allUsers()
    {
        $users = achievmentsUsers::with('user')->get();
        return $this->success($users, 'all users');
    }

    public function singleUser()
    {
        $user = achievmentsUsers::with('user')->find(request('id'));
        return $this->success($user, 'user fetched successfully');
    }

    public function addUser(Request $request)
    {
        $data = $request->all();
        $achievement = achievmentsUsers::create([
            'user_id' => $data['user_id'],
            'added_by_id' => auth()->user()->id,
            'school_id' => auth()->user()->school_id,
            'achievment' => $data['achievment'],
        ]);
        return $this->success($achievement, 'user created successfully');
    }

    public function deleteUser()
    {
        achievmentsUsers::find(request('id'))->delete();
        return $this->noContent();
    }
}