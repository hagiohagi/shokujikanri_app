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

        return view('project.list', ['survey_info' => $survey_info]);
    }

    public function search(Request $request, $survey_id)
    {
        $survey_info = SurveyInfo::with('users', 'users.mealrecords', 'users.mealrecords.mealPhotos', 'users.mealrecords.mealDetails')->find($survey_id);

        if (isset($request->user_name)) {
            $survey_info = $survey_info
                ->whereHas('users', function ($query) use ($request) {
                    $query->where('name', '=', $request->user_name);
                });
        }

        // if (isset($request->survey_sort)){
        //     if($request->survey_sort == 1){
        //         $survey_info = $survey_info->latest();
        //     }elseif($request->survey_sort == 2){
        //         $survey_info = $survey_info->oldest();
        //     }elseif($request->survey_sort == 3){
        //         $survey_info = $survey_info->sortBy('users.name');
        //     }
        // }


        return view('project.list', ['survey_info' => $survey_info]);
    }
}
