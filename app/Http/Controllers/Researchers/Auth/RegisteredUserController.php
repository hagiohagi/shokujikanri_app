<?php

namespace App\Http\Controllers\Researchers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Researcher;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use App\Rules\ReseacherResearchNumber;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return view('researchers.auth.register');
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
            'sex_type' =>['required','string'],
            'height' =>['required','numeric','max:999'],
            'weight' =>['required','numeric','max:999'],
            'fat_percentage' =>['numeric','max:99'],
            'sport_name' =>['required','string'],
            'sport_position' =>['string'],
            'email_confirmation' => ['required', 'string'],
            'email' => 'required|string|email|max:255|unique:researchers',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required', 'string'],
            'research_number' => ['required', 'string', 'digits:6', new ReseacherResearchNumber],
        ]);

        $user = Researcher::create([
            'name' => $request['name'],
            'sex_type' =>$request['sex_type'],
            'height' =>$request['height'],
            'weight' =>$request['weight'],
            'fat_percentage' =>$request['fat_percentage'],
            'sport_name' =>$request['sport_name'],
            'sport_position' =>$request['sport_positon'] ,
            'email' =>$request['email'],
            'password' =>Hash::make($request['password']),
            'auth_type' => 2,
            // 'create_user_id' => Auth::id(),
            'create_user_id' => 1, ##とりあえずテスト用
        ]);

        event(new Registered($user));

        Auth::guard('researchers')->login($user);

        return redirect(RouteServiceProvider::PROJECT);
    }
}
