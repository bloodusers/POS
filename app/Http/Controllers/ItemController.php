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
        return view('item.index', ['data' => Category::with('children')->where('organization_id', Auth::user()->organization_id)->whereNull('category_id')->get()]);
    }

    public function edit($id)
    {
        //dd(Item::find($id));
        return (view('item.index', ['data' => Category::with('children')->where('organization_id', Auth::user()->organization_id)->whereNull('category_id')->get(),
            'info' => Item::find($id)]));
    }

    public function editList()
    {
        $result = Category::select('id')->where('organization_id', Auth::user()->organization_id)->get();
        $temp = array();
        foreach ($result as $res) {
            array_push($temp, $res->id);
        }
        return ValidateUserSession(view('item.editList', ['data' => (Item::orderBy('created_at')->whereIn('category_id', getFeild('id', 'categories', 'organization_id =' . Auth::user()->organization_id))
            ->paginate(10))]), 'canEdit', redirect(back()));
    }

    public function delete($id)
    {
        //$temp=Item::all()->count();
        $name=Item::find($id)->name;
        if(Item::find($id)->delete()) {
            DB::select(DB::raw("ALTER TABLE items AUTO_INCREMENT =" . 0));
            return redirect()->route('editItem')->with('success','item '.$name.' deleted successfully');
        }
        return redirect()->route('item.edit')->withErrors('error','ERROR');
        // return redirect(route('editCategory'));
    }

    public function update($id)
    {
        //dd($id);
        // dd(request()->all());
        $data = \request()->validate(
            [
                'name' => 'required',
                'description' => 'nullable',
                'category_id' => 'required|Numeric',
                'item_code' => 'required',
                //'image'=>'required',
                'price' => 'required|Numeric',
            ]
        );
        // dd($data);
        if ($data['image'] ?? '') {
            $imagePath = $data['image']->store('uploads', 'public');
            $data['image'] = $imagePath;
        }
        // dd($data);
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
                'item_code' => 'required',
                'image' => 'required',
                'price' => 'required',
            ]
        );
        $imagePath = $data['image']->store('uploads', 'public');
        $data['image'] = $imagePath;
        //dd($data);
        Item::create($data);
        return back();
    }
}
