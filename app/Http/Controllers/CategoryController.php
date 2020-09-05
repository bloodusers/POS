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
        return view('category.index',['data' => Category::with('children')->whereNull('category_id')->get(),
            'count'=>Organization::all()->count()]);
        // else
        //   return redirect(route('login'));
    }

    public function view()
    {
        //            return view('admin.index', ['data' => Organization::paginate(5),'count'=>Organization::all()->count()]);

        //return view('category.view', ['data' => Category::all()->where('organization_id', '=',Auth::user()->organization_id),'count'=>Organization::all()->count()]);
        return view('category.view', ['data' => Category::with('children')->whereNull('category_id')->get(),
            'count'=>Organization::all()->count()]);
        //return Category::with('children')->whereNull('category_id')->get();

    }

    public function create()
    {
        //dd(\request());
        $data = \request()->validate(
            [
                'name' => 'required',
                'description'=>'nullable',
               'category_id'=>'nullable',
            ]
        );
        $data['organization_id'] = Auth::user()['organization_id'];
        //dd($data);
        //return \App\Organization::create($data);
        //dd($data);
        Category::create($data);
        return $this->view();
    }
}
