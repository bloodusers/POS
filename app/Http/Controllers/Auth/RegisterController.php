<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'organization_id' => 'required',
            'role_id' => 'required',
            'contact' => 'required|min:11|numeric',
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
            'password_confirmation' => 'required',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create()
    {
        $data = \request()->validate(
            [
                'name' => 'required',
                'contact' => 'required|min:11|numeric',
                'email' => 'required|email:rfc,dns',
                'organization_id' => 'required|numeric',
                'role_id' => 'required|numeric',
                'password' => 'required',
                'password_confirmation' => 'required',
            ]
        );
        $data['password'] = Hash::make($data['password']);

      // dd($data);

        return User::create($data);

        /*
        $data = \request()->validate(
            [
                'name' => 'required',
                'contact' => 'required|min:11|numeric',
                'email' => 'required|email:rfc,dns',
                'organization_id' => 'required|numeric',
                'role_id' => 'required|numeric',
                'password' => 'required',
                'password_confirmation' => 'required',
            ]
        );
        <!-- @if (Auth::user()->name == 'admin' && Auth::user()->shortName == 'admin' && Auth::user()->contactPerson == 'admin')-->
        Auth::user()->role->rolePrivileges['canView']
        */
    }
}
