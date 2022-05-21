<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SurveyInfo;
use Illuminate\Support\Facades\Auth;

class ProjectEditController extends Controller
{
    public function index(Request $request,$survey_id)
    {
        $survey_info = SurveyInfo::find($survey_id);
        return view('admin.project_edit',['survey_info' => $survey_info]);
    }

    public function update(Request $request, $survey_id)
    {
        $survey_info = SurveyInfo::find($survey_id);

        $rules = [
            'survey_name' => ['required', 'string'],
            'term' => ['required', 'string'],
            'era' => ['required', 'string'],
            'sex' => ['required', 'string'],
            'sport' => ['required', 'string'],
        ];

        $this->validate($request, $rules);

        $survey_info->update([
            'survey_name' => $request['survey_name'],
            'term' =>$request['term'],
            'era' =>$request['era'],
            'sex' =>$request['sex'],
            'sport' =>$request['sport'],
            'update_user_id' => Auth::id(),
        ]);
        return redirect()->route('admin.project');
    }

    // public function delete(Request $request, $survey_id) {

    //     $survey_info = SurveyInfo::find($survey_id);
    //     $survey_info->delete();
    // }
}
