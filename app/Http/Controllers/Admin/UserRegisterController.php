<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
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
        $user = new User();

        $rules = [
            'user_name' => ['required', 'string'],
            'sex_type' =>['required','string'],
            'height' =>['required','integer','max:999'],
            'weight' =>['required','integer','max:999'],
            'fat_percentage' =>['required','integer','max:99'],
            'sport_name' =>['required','string'],
            'sport_position' =>['string'],
            'email' => ['required', 'email'],
            'email_confirmation' => ['required', 'string'],
            'password' => ['required', 'string'],
            'password_confirmation' => ['required', 'string'],
            'auth_type' => ['required']
        ];

        $this->validate($request, $rules);

        $user->create([
            'user_name' => $request['user_name'],
            'sex_type' =>$request['sex_type'],
            'height' =>$request['height'],
            'weight' =>$request['weight'],
            'fat_percentage' =>$request['fat_percentage'],
            'sport_name' =>$request['sport_name'],
            'sport_position' =>$request['sport_positon'] ,
            'email' =>$request['email'],
            'password' =>Hash::make($request['password']),
            'ayth_type' =>$request['auth_type'],
            // 'create_user_id' => Auth::id(),
            'create_user_id' => 1, ##とりあえずテスト用
        ]);

        return redirect()->route('admin.user');
    }
}
