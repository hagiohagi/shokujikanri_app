<?php

namespace App\Http\Controllers\Project;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SurveyInfo;

class ListController extends Controller
{
    public function index(Request $request, $survey_id)
    {
        $survey_info = SurveyInfo::with('users', 'users.mealrecords', 'users.mealrecords.mealPhotos', 'users.mealrecords.mealDetails')->find($survey_id);
        $users = $survey_info->users;

        return view('project.list', ['survey_info' => $survey_info, 'users' => $users]);
    }

    public function search(Request $request, $survey_id)
    {
        $survey_info = SurveyInfo::with('users', 'users.mealrecords', 'users.mealrecords.mealPhotos', 'users.mealrecords.mealDetails')->find($survey_id);
        $users = $survey_info->users;

        if (isset($request->user_name)) {
            $users = $users->where('name', '=', $request->user_name);
        }

        if (isset($request->survey_sort)) {

            if ($request->survey_sort == 1) {
                foreach ($users as $user) {
                    $meal_records = $user->mealrecords;
                    $user->mealrecords = $meal_records->sortByDesc('created_at')->values();
                }
            } elseif ($request->survey_sort == 2) {
                foreach ($users as $user) {
                    $meal_records = $user->mealrecords;
                    $user->mealrecords = $meal_records->sortBy('created_at')->values();
                }
            } elseif ($request->survey_sort == 3) {
                $users = $users->sortBy('name')->values();
            }
        }

        return view('project.list', ['survey_info' => $survey_info, 'users' => $users]);
    }
}
