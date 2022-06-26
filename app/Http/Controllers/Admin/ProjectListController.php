<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SurveyInfo;

class ProjectListController extends Controller
{
    public function index(Request $request,$survey_id)
    {
        $survey_info = SurveyInfo::with('users', 'users.mealrecords', 'users.mealrecords.mealPhotos', 'users.mealrecords.mealDetails')->find($survey_id);
        $users = $survey_info->users;
        $meal_records = [];
        foreach ($users as $user) {
            $meal_records[] = $user->mealrecords;
        }

        return view('admin.project_list', ['survey_info' => $survey_info, 'users' => $users, 'meal_records' => $meal_records]);
    }
    
    public function search(Request $request, $survey_id)
    {
        $survey_info = SurveyInfo::with('users', 'users.mealrecords', 'users.mealrecords.mealPhotos', 'users.mealrecords.mealDetails')->find($survey_id);
        $users = $survey_info->users;
        $meal_records = [];
        foreach ($users as $user) {
            $meal_records[] = $user->mealrecords;
        }

        // dd($meal_records);

        if (isset($request->user_name)) {
            $users = $users->where('name', '=', $request->user_name);
        }

        if($request->survey_sort == 1){
            foreach($users as $user) {
                $meal_records = $user->mealrecords;
                $user->mealrecords = $meal_records->sort(function($first, $second) {
                    if ($first['eat_date'] == $second['eat_date']) {
                        return $first['eat_time'] < $second['eat_time'] ? 1 : -1;
                    }
                
                    return $first['eat_date'] < $second['eat_date'] ? 1 : -1;
                })->values();
            }
            // $users = $users->sortBy('mealrecords.eat_date')->values();
        }elseif($request->survey_sort == 2){
            foreach($users as $user) {
                $meal_records = $user->mealrecords;
                $user->mealrecords = $meal_records->sort(function($first, $second) {
                    if ($first['eat_date'] == $second['eat_date']) {
                        return $first['eat_time'] > $second['eat_time'] ? 1 : -1;
                    }
                
                    return $first['eat_date'] > $second['eat_date'] ? 1 : -1;
                })->values();
            }
        }elseif($request->survey_sort == 3){
            $users = $users->sortBy('name')->values();
        }

        return view('admin.project_list', ['survey_info' => $survey_info, 'users' => $users, 'meal_records' => $meal_records]);
    }
}
