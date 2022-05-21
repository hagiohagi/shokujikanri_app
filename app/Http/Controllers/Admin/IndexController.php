<?php

namespace App\Http\Controllers\Admin;

use App\Models\MealRecord;
use App\Models\MealPhoto;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(Request $request, $id)
    {
        $user = User::find($id);
        $meals = MealRecord::with('mealPhotos')->where('user_id', $user->id)->get();

        return view('admin.index',['user' => $user,'meals' => $meals]);
    }
}
