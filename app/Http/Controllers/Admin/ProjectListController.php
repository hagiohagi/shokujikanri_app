<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SurveyInfo;

class ProjectListController extends Controller
{
    public function index(Request $request,$survey_id)
    {
        $survey_info = SurveyInfo::find($survey_id);
        return view('admin.project_list',['survey_info' => $survey_info]);
    }
}
