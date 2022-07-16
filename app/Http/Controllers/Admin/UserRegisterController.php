<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Researcher;
use App\Models\Admin;
use App\Models\SurveyInfo;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.user_register');
    }

    public function register(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string'],
            'sex_type' => ['required', 'string'],
            'height' => ['required', 'numeric', 'max:999'],
            'weight' => ['required', 'numeric', 'max:999'],
            'fat_percentage' => ['nullable','numeric', 'max:99'],
            'sport_name' => ['required', 'string'],
            'sport_position' => ['string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'email_confirmation' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required', 'string'],
            'auth_type' => ['required', 'integer'],
        ]);

        if ($request['auth_type'] == 1 && SurveyInfo::where('research_number', '=', $request['research_number'])->doesntExist()) {
            abort(404);
        }


        // 管理者の場合
        if ($request->auth_type == 3) {
            $admin = new Admin();
            $admin->create([
                'name' => $request['name'],
                'sex_type' => $request['sex_type'],
                'height' => $request['height'],
                'weight' => $request['weight'],
                'fat_percentage' => $request['fat_percentage'],
                'sport_name' => $request['sport_name'],
                'sport_position' => $request['sport_positon'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'auth_type' => $request['auth_type'],
                'create_user_id' => Auth::id(),
            ]);
        }
        // 研究者の場合
        elseif ($request->auth_type == 2) {
            $researcher = new Researcher();
            $researcher->create([
                'name' => $request['name'],
                'sex_type' => $request['sex_type'],
                'height' => $request['height'],
                'weight' => $request['weight'],
                'fat_percentage' => $request['fat_percentage'],
                'sport_name' => $request['sport_name'],
                'sport_position' => $request['sport_positon'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'auth_type' => $request['auth_type'],
                'create_user_id' => Auth::id(),
            ]);
        }
        // 回答者の場合
        else {
            $user = User::create([
                'name' => $request['name'],
                'sex_type' => $request['sex_type'],
                'height' => $request['height'],
                'weight' => $request['weight'],
                'fat_percentage' => $request['fat_percentage'],
                'sport_name' => $request['sport_name'],
                'sport_position' => $request['sport_positon'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'auth_type' => $request['auth_type'],
                'create_user_id' => Auth::id(),
            ]);

            $survey_info = SurveyInfo::where('research_number', '=', $request['research_number'])->first();
            $survey_info->users()->attach($user->id, ['create_user_id' => $user->id]);

            event(new Registered($user));

            $request_password = $request['password'];
            $user->registered($user, $request_password);
        }

        return redirect()->route('admin.user');
    }
}
