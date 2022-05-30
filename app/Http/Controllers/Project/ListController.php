<?php

namespace App\Http\Controllers\Project;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SurveyInfo;

class ListController extends Controller
{
    public function index(Request $request, $survey_id)
    {
        $survey_info = SurveyInfo::with('users.mealrecords','users.mealrecords.mealPhotos','users.mealrecords.mealDetails')->find($survey_id);

        if (isset($request->user_name)) {
            $survey_info->whereHas('users',function($query) use ($request){
                $query->where('name', $request->user_name);
        })->get();
    }

        return view('project.list',['survey_info' => $survey_info]);
    }

    
}
