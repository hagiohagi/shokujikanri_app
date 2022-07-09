<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SurveyInfo;
use Illuminate\Support\Facades\Auth;

class ProjectRegisterController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.project_register');
    }

    public function register(Request $request)
    {
        $survey_info = new SurveyInfo();


        $rules = [
            'survey_name' => ['required', 'string'],
            'term' => ['required', 'string'],
            'era' => ['required', 'string'],
            'sex' => ['required', 'string'],
            'sport' => ['required', 'string'],
            'research_number' => ['required', 'string', 'unique:survey_info', 'digits:6'],
        ];

        $this->validate($request, $rules);

        $survey_info->create([
            'survey_name' => $request['survey_name'],
            'term' =>$request['term'],
            'era' =>$request['era'],
            'sex' =>$request['sex'],
            'sport' =>$request['sport'],
            'research_number' => $request['research_number'],
            'create_user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.project');
    }
}
