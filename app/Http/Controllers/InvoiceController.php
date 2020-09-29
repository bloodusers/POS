<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
