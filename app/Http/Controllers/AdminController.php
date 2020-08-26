<?php

namespace App\Http\Controllers;

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
        if ((Auth::user()->name == Auth::user()->shortName) && Auth::user()->shortName == Auth::user()->contactPerson && Auth::user()->contactPerson == 'admin')
            return view('admin.index');
        else
            return redirect(route('login'));
    }

    public function update($user)
    {
        $user = User::find($user);
        $user->isActive = !$user->isActive;
        $user->push();
        return redirect(route('adminPage'));
        //dd(($user));
        //return view(route('adminPage'));
        //return view('admin.index');
    }
}
