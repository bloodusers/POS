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
        //if ((Auth::user()->name == Auth::user()->shortName) && Auth::user()->shortName == Auth::user()->contactPerson && Auth::user()->contactPerson == 'admin')
        if (Auth::user()->role->rolePrivileges["canView"])
        {
            //$data=DB::table('organizations')->simplePaginate(5);
            return view('admin.index', ['data' => Organization::paginate(5)]);
        }
        else
            return redirect(route('login'));
    }

    public function update($user)
    {
        $user = Organization::find($user);
        $user->isActive = !$user->isActive;
        $user->push();
        // return redirect(route('adminPage'));
        return redirect()->back()->with('Success', 'Status successfully!');
        //dd(($user));
        //return view(route('adminPage'));
        //return view('admin.index');
    }
}
