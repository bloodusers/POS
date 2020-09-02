<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Organization;
use App\Providers\RouteServiceProvider;
use  Illuminate\Validation\Validator;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
       // if (Auth::user()->role->rolePrivileges["canAdd"])
            return view('category.index');
       // else
         //   return redirect(route('login'));
    }
    public function view()
    {
        return view('category.view');
    }
    public function create()
    {
        $data = \request()->validate(
            [
                'name' => 'required',
                'description' => 'required',
            ]
        );
        $data['organization_id'] = Auth::user()['organization_id'];
        //dd($data);
        //return \App\Organization::create($data);
        Category::create($data);
        return redirect(route('home'));
    }
}
