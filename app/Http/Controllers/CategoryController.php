<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Organization;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\DB;
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
        return view('category.index', ['data' => Category::with('children')->whereNull('category_id')->get(),
            'count' => Organization::all()->count()]);
        // else
        //   return redirect(route('login'));
    }

    public function view()
    {
        return ValidateUserSession(view('category.view', ['data' => Category::with('children')->
        whereNull('category_id')->get(),
            'count' => Organization::all()->count(), 'canEdit' => 1]), 'canEdit', view('category.view', ['data' =>
            Category::with('children')->whereNull('category_id')->get(),
            'count' => Organization::all()->count(), 'canEdit' => 0]));
    }

    public function editList()
    {
        return ValidateUserSession(view('category.editList', ['data' => (Category::orderBy('created_at')->paginate(10))]), 'canEdit', redirect(back()));
    }

    public function edit($id)
    {
        return ValidateUserSession(view('category.index', ['data' => Category::with('children')->whereNull('category_id')->get(),
            'info' => Category::find($id)]), 'canEdit');
    }

    public function update($id)
    {
        $data = \request()->validate(
            [
                'name' => 'required',
                'description' => 'nullable',
                'category_id' => 'nullable',
            ]
        );
        Category::where('id', $id)->update($data);
        return redirect(route('editCategory'));

    }

    public function delete($id)
    {

        //dd($id);
        $temp=Category::all()->count();
        $name=Category::find($id)->name;
        //dd($temp);
        if(Category::find($id)->delete()) {
            DB::select(DB::raw("ALTER TABLE categories AUTO_INCREMENT =" . 0));
            return redirect()->route('editCategory')->with('success','Category '.$name.' deleted successfully');
        }
        return back()->withInput()->withErrors('error','ERROR');
       // return redirect(route('editCategory'));
    }

    public function create()//regCategory
    {
        //dd(\request());
        $data = \request()->validate(
            [
                'name' => 'required',
                'description' => 'nullable',
                'category_id' => 'nullable',
            ]
        );
        $data['organization_id'] = Auth::user()['organization_id'];
        Category::create($data);
        return $this->view();
    }
}
