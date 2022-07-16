<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SurveyInfo;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Rules\ResearchNumber;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'sex_type' => ['required', 'string'],
            'height' => ['required', 'numeric', 'max:999'],
            'weight' => ['required', 'numeric', 'max:999'],
            'fat_percentage' => ['nullable', 'numeric', 'max:99'],
            'sport_name' => ['required', 'string'],
            'sport_position' => ['string'],
            'email_confirmation' => ['required', 'string'],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required', 'string'],
            'research_number' => ['required', 'string', 'digits:6', new ResearchNumber],
        ]);

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
            'auth_type' => 1,
            'create_user_id' => 1, ##とりあえずテスト用
        ]);

        $survey_info = SurveyInfo::where('research_number', '=', $request['research_number'])->first();
        $survey_info->users()->attach($user->id, ['create_user_id' => $user->id]);

        event(new Registered($user));

        $request_password = $request['password'];
        $user->registered($user, $request_password);

        Auth::login($user);

        $user->update([
            'create_user_id' => Auth::id(),
        ]);

        return redirect(RouteServiceProvider::HOME);
    }
}
