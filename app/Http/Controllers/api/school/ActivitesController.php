<?php

namespace App\Http\Controllers\api\school;

use App\Http\Controllers\api\store\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\activity;
use App\Models\behaviour;
use App\Models\interaction;
use App\Models\User;
use Illuminate\Http\Request;

class ActivitesController extends Controller
{
    use ApiResponse;

    public function getActivity(Request $request)
    {
        $data = User::with('activity', 'behaviour', 'interaction')->find($request->user_id);
        return $this->success($data, 'user activity fetched');
    }

    public function createActivity(Request $request)
    {
        $data = $request->all();
        try {
            $activity = activity::create($data);
            return $this->success($activity, 'activity created');
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }

    public function updateActivity(Request $request)
    {
        $data = $request->all();
        $activity = activity::find(request('id'));
        try {
            $activity->update($data);
            return $this->success($activity, 'activity updated');
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }

    public function deleteActivity(Request $request)
    {
        $activity = activity::find(request('id'));
        try {
            $activity->delete();
            return $this->noContent();
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }

    public function createbehaviour(Request $request)
    {
        $data = $request->all();
        try {
            $behaviour = behaviour::create($data);
            return $this->success($behaviour, 'behaviour created');
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }

    public function updatebehaviour(Request $request)
    {
        $data = $request->all();
        $behaviour = behaviour::find(request('id'));
        try {
            $behaviour->update($data);
            return $this->success($behaviour, 'behaviour updated');
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }

    public function deletebehaviour(Request $request)
    {
        $behaviour = behaviour::find(request('id'));
        try {
            $behaviour->delete();
            return $this->noContent();
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }

    public function createinteraction(Request $request)
    {
        $data = $request->all();
        try {
            $interaction = interaction::create($data);
            return $this->success($interaction, 'interaction created');
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }

    public function updateinteraction(Request $request)
    {
        $data = $request->all();
        $interaction = interaction::find(request('id'));
        try {
            $interaction->update($data);
            return $this->success($interaction, 'interaction updated');
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }

    public function deleteinteraction(Request $request)
    {
        $interaction = interaction::find(request('id'));
        try {
            $interaction->delete();
            return $this->noContent();
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }
}