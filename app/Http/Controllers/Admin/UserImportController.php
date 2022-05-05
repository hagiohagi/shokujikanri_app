<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserImportController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.user_import');
    }
}
