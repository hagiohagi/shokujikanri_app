<?php

namespace App\Http\Controllers\Project;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SurveyInfo;

class ListController extends Controller
{
    public function index(Request $request,$survey_id)
    {
        $survey_info = SurveyInfo::with('users.mealrecords','users.mealrecords.mealPhotos','users.mealrecords.mealDetails')->find($survey_id);

        if (isset($request->input['user_name'])) {
            $survey_info->whereHas('user_name',$request->user_name)->get();
        }
        
        return view('project.list',['survey_info' => $survey_info]);
    }

    
}
