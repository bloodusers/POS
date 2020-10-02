<?php

namespace App\Http\Controllers;

use App\Category;
use App\Invoice;
use App\Item;
use App\Organization;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('invoice.index');
    }
    public function receipt($id)
    {
        $uOrgIds=getFeild('id','users','organization_id ='.Auth::user()->organization_id);
        return view('invoice.receipt', ['data' => Invoice::with('invoiceItems')->where('id',$id)->
        whereIn('user_id',$uOrgIds)->get()]);
    }
    public function create()
    {
        $data = \request()->validate(
            [
                'customerName' => 'required',
                'remarks' => '',
                'totalAmount' => 'required',
                'totalItems' => 'required',
                'discount' => 'required',
                'payableAmount' => 'required',
            ]
        );
        $data['user_id'] = Auth::user()->id;
        return Invoice::create($data)->id;
        return $data;
    }
    /* public function create()
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
        Organization::create($data);
        // dd($data);
        //return \App\Organization::create($data);
        return redirect(route('home'));
    }*/
}
