<?php

namespace App\Http\Controllers;

use App\Organization;
use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
            return ValidateUserSession(view('admin.index', ['data' => Organization::paginate(10)]),
                'canView');
    }

   /* public function update($user)
    {
        $user = Organization::find($user);
        $user->isActive = !$user->isActive;
        $user->push();
        // return redirect(route('adminPage'));
        return redirect()->back()->with('Success', 'Status successfully!');
        //dd(($user));
        //return view(route('adminPage'));
        //return view('admin.index');
    }*/
}
