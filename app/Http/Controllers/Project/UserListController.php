<?php

namespace App\Http\Controllers\Project;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SurveyInfo;

class UserListController extends Controller
{
    public function index(Request $request, $survey_id)
    {
        $survey_info = SurveyInfo::with('users')->find($survey_id);
        $users = $survey_info->users;

        return view('project.user_list', ['survey_info' => $survey_info, 'users' => $users,]);
    }

}
