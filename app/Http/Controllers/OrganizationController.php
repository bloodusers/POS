<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Request;
use App\Organization;
use App\Providers\RouteServiceProvider;
use  Illuminate\Validation\Validator;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class OrganizationController extends Controller
{
    /* public function create()
     {
         return view('orgnization.registerorg');
     }*/
    /*protected function asd(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }*/
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        /* if (Auth::user()->role->rolePrivileges["canAdd"])
             return view('organization.index');
         else
             return redirect(route('login'));*/
        return ValidateUserSession(view('organization.index'), "canAdd");
    }

    public function edit($id)
    {
       //dd($id);
        return ValidateUserSession(view('organization.index',['data' => Organization::find($id)]), "canEdit");
    }
    public function update($id)
    {
        $data = \request()->validate(
            [
                'name' => 'required',
                'shortName' => 'required',
                'contactPerson' => 'required',
                'contact' => 'required|min:11|numeric',
                'email' => 'required|email:rfc,dns',
            ]
        );
        Organization::where('id',$id)->update($data);
       //dd(Organization::find($id));
        return redirect(route('adminPage'));
    }
    public function toggleStatus($user)
    {
        $user = Organization::findOrFail($user);
        $user->isActive = !$user->isActive;
        $user->push();
        //sleep(2);
        return $user->isActive;
        //return redirect()->back()->with('Success', 'Status successfully!');
    }
    public function create()
    {
        $data = \request()->validate(
            [
                'name' => 'required',
                'shortName' => 'required',
                'contactPerson' => 'required',
                'contact' => 'required|min:11|numeric',
                'email' => 'required|email:rfc,dns',
            ]
        );
        //date("Y-m-d")
        $data['regDate'] = date("Y-m-d");
        Organization::create($data);
        // dd($data);
        //return \App\Organization::create($data);
        return redirect(route('home'));
    }
}
