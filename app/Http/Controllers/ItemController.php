<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return (view('item.index', ['data' => Category::with('children')->where('organization_id',Auth::user()->organization_id)->whereNull('category_id')->get(),
            'info' => Category::find($id)]));
    }
    public function editList()
    {
        return ValidateUserSession(view('item.editList', ['data' => (Item::orderBy('created_at')->paginate(10))]), 'canEdit', redirect(back()));
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
        //dd(($data['image']));
        //dd(Auth::user()->organization->name);
        Storage::put('/public/'.Auth::user()->organization->name.'/', $data['image']);
        dd(request('image'));
        /*$imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"));
        $image->save();
        $data['image']=$imagePath;*/
        dd($data);
        Item::create($data);
        return back();
    }
}
