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
        return view('category.index', ['data' => Category::with('children')->where('organization_id',Auth::user()->organization_id)->
        whereNull('category_id')->get(),
            'count' => Organization::all()->count()]);
        // else
        //   return redirect(route('login'));
    }

    public function view()
    {
        return ValidateUserSession(view('category.view', ['data' => Category::with('children')->where('organization_id',Auth::user()->organization_id)->
        whereNull('category_id')->get()]), 'canEdit', view('category.view', ['data' =>
            Category::with('children')->whereNull('category_id')->get(), 'canEdit' => 0]));
    }

    public function editList()
    {
        return ValidateUserSession(view('category.editList', ['data' => (Category::orderBy('created_at')->where('organization_id',Auth::user()->organization_id)->
        paginate(10))]), 'canEdit', redirect(back()));
    }

    public function edit($id)
    {
        return ValidateUserSession(view('category.index', ['data' => Category::with('children')->where('organization_id',Auth::user()->organization_id)->whereNull('category_id')->get(),
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

        $temp=Category::all()->count();
        $name=Category::find($id)->name;
        if(Category::find($id)->delete()) {
            DB::select(DB::raw("ALTER TABLE categories AUTO_INCREMENT =" . 0));
            return redirect()->route('category.edit')->with('success','Category '.$name.' deleted successfully');
        }
        return redirect()->route('category.edit')->withErrors('error','ERROR');
    }

    public function create()//regCategory
    {
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
