<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserEditController extends Controller
{
    public function index(Request $request,$id)
    {
        $user = User::find($id);
        return view('admin.user_edit',['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $rules = [
            'name' => ['required', 'string'],
            'sex_type' =>['required','string'],
            'height' =>['required','integer','max:999'],
            'weight' =>['required','integer','max:999'],
            'fat_percentage' =>['required','integer','max:99'],
            'sport_name' =>['required','string'],
            'sport_position' =>['string'],
            'auth_type' => ['required','integer'],
        ];

        $this->validate($request, $rules);

        $user->update([
            'name' => $request['name'],
            'sex_type' =>$request['sex_type'],
            'height' =>$request['height'],
            'weight' =>$request['weight'],
            'fat_percentage' =>$request['fat_percentage'],
            'sport_name' =>$request['sport_name'],
            'sport_position' =>$request['sport_positon'] ,
            'auth_type' =>$request['auth_type'],
            'updatete_user_id' => Auth::id(),
        ]);
        return redirect()->route('admin.user');
    }

    // public function delete(Request $request, $id) {

    //     $user = User::find($id);
    //     $user->mealRecords()->each(function ($meal_record) {
    //         $meal_record->mealPhotos()->delete();
    //         $meal_record->mealDetails()->delete();
    //     });
    //     $user->mealRecords()->delete();
    //     $user->delete();

    //     return redirect()->route('admin.user');

    // }
}
