<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SurveyInfo;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $survey_info = SurveyInfo::all();
        return view('admin.project', ['survey_info' => $survey_info]);
    }
}
