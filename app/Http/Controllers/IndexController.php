<?php

namespace App\Http\Controllers;

use App\Models\MealRecord;
use App\Models\MealPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(Request $request)
    {

        $meals = MealRecord::with('mealPhotos')->where('user_id', Auth::user()->id)->get();

        return view('index',['meals' => $meals]);
    }
}
