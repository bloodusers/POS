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

    public function index()
    {
        if (Auth::user()->role->rolePrivileges[0]["canAdd"])
            return view('organization.index');
        else
            return redirect(route('login'));
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
       // dd($data);
        \App\Organization::create($data);
        return redirect(route('home'));
    }
}
