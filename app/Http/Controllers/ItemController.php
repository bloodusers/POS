<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('item.index', ['data' => Category::with('children')->where('organization_id',Auth::user()->organization_id)->whereNull('category_id')->get()]);
    }
    public function edit($id)
    {
        //dd(Item::find($id));
        return (view('item.index', ['data' => Category::with('children')->where('organization_id',Auth::user()->organization_id)->whereNull('category_id')->get(),
            'info' => Item::find($id)]));
    }
    public function editList()
    {
        //$result=db::select(DB::raw('select id from categories where organization_id = '.Auth::user()->organization_id.';'));
        $result=Category::select('id')->where('organization_id',Auth::user()->organization_id )->get();
       // dd($result);
        $temp=array();
        //dd($result[1]->id);
        foreach ($result as $res)
        {
            array_push($temp,$res->id);
        }
       //dd($temp);
        //dd(Item::all()->whereIn('category_id',$temp));
        return ValidateUserSession(view('item.editList', ['data' => (Item::orderBy('created_at')->whereIn('category_id',$temp)->paginate(10))]), 'canEdit', redirect(back()));
    }
    public function update($id)
    {
        //dd($id);
        $data = \request()->validate(
            [
                'name' => 'required',
                'description' => 'nullable',
                'category_id' => 'required',
                'item_code'=>'required',
                'image'=>'required',
            ]
        );
        $imagePath=$data['image']->store('uploads','public');
        $data['image']=$imagePath;
        Item::where('id', $id)->update($data);
        return redirect(route('editCategory'));

    }
    public function create()//regItem
    {
        //dd(request()->all());
        $data = \request()->validate(
            [
                'name' => 'required',
                'description' => 'nullable',
                'category_id' => 'required',
                'item_code'=>'required',
                'image'=>'required',
            ]
        );
        $imagePath=$data['image']->store('uploads','public');
        //dd($imagePath.' Path');
        $data['image']=$imagePath;
        //dd($data);
        Item::create($data);
        return back();
    }
}
