<?php

namespace App\Http\Controllers;

use App\Organization;
use App\User;
use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //if ((Auth::user()->name == Auth::user()->shortName) && Auth::user()->shortName == Auth::user()->contactPerson && Auth::user()->contactPerson == 'admin')
        if (Auth::user()->role->rolePrivileges[0]["canView"])
            return view('admin.index');
        else
            return redirect(route('login'));
    }

    public function update($user)
    {
        $user = Organization::find($user);
        $user->isActive = !$user->isActive;
        $user->push();
        return redirect(route('adminPage'));
        //dd(($user));
        //return view(route('adminPage'));
        //return view('admin.index');
    }
}
