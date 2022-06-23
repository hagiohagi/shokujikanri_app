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
        $meal_records = [];
        foreach ($users as $user) {
            $meal_records[] = $user->mealrecords;
        }


        return view('project.list', ['survey_info' => $survey_info, 'users' => $users, 'meal_records' => $meal_records]);
    }

    public function search(Request $request, $survey_id)
    {
        $survey_info = SurveyInfo::with('users', 'users.mealrecords', 'users.mealrecords.mealPhotos', 'users.mealrecords.mealDetails')->find($survey_id);
        $users = $survey_info->users;
        $meal_records = [];
        foreach ($users as $user) {
            $meal_records = $user->mealrecords;
        }

        // dd($meal_records);

        if (isset($request->user_name)) {
            $users = $users->where('name', '=', $request->user_name);
        }

        if (isset($request->survey_sort)) {

            if ($request->survey_sort == 1) {
                $meal_records = $meal_records->sortBy('created_at')->values();
            } elseif ($request->survey_sort == 2) {
                $meal_records = $meal_records->sortByDesc('created_at')->values();
            } elseif ($request->survey_sort == 3) {
                $users = $users->sortBy('name')->values();
            }
        }

        return view('project.list', ['survey_info' => $survey_info, 'users' => $users, 'meal_records' => $meal_records]);
    }
}
