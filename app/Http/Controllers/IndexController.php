<?php

namespace App\Http\Controllers;

use App\Models\MealRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(Request $request)
    {

        $meals = MealRecord::where('user_id', Auth::user()->id)->get();

        return view('index',['meals' => $meals]);
    }
}
