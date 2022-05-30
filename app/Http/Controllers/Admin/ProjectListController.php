<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SurveyInfo;

class ProjectListController extends Controller
{
    public function index(Request $request,$survey_id)
    {
        $survey_info = SurveyInfo::with('users.mealrecords','users.mealrecords.mealPhotos','users.mealrecords.mealDetails')->find($survey_id);

        return view('admin.project_list',['survey_info' => $survey_info]);
    }
    
    public function search(Request $request,$survey_id)
    {
        $survey_info = SurveyInfo::with('users.mealrecords','users.mealrecords.mealPhotos','users.mealrecords.mealDetails')->find($survey_id)->query();

        
        if (isset($request->input['user_name'])) {
            $survey_info->whereHas('user_name',$request->user_name)->get();
        }

        return view('admin.project_list',['survey_info' => $survey_info]);
    }
}
