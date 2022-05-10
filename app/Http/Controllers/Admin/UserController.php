<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Researcher;
use App\Models\Admin;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(Request $request, User $user)
    {
        // if (! Gate::allows('admin', $user)) {
        //     abort(403);
        // }
        
        $user = User::all()->toArray();
        $researcher = Researcher::all()->toArray();
        $admin = Admin::all()->toArray();

        $accounts = array_merge($user,$researcher,$admin);

        return view('admin.user', ['accounts' => $accounts]);
    }
}
