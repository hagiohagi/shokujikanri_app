<?php

namespace App\Http\Controllers\Project;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SurveyInfo;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $survey_info = SurveyInfo::all();
        return view('project.index', ['survey_info' => $survey_info]);
    }
    
}
