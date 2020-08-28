<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Requests\Request;
use App\Organization;
use App\Providers\RouteServiceProvider;
use  Illuminate\Validation\Validator;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrganizationController extends Controller
{
    public function create()
    {
        return view('orgnization.registerorg');
    }
    /*protected function asd(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }*/
    protected $redirectTo = RouteServiceProvider::HOME;
    public function store()
    {
        $data = \request()->validate(
           [
                'name' => 'required',
                'shortName' => 'required',
                'contactPerson' => 'required',
                'contact' => 'required|min:11|numeric',
                'email' => 'required|email:rfc,dns',
                'regDate' => 'required',
            ]
        );
        \App\Organization::create($data);
        return view('welcome');
    }
}
