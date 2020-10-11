<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\ReturnInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('returnInvoice.index',['data' =>['invId'=>0]]);
    }
    public function create()
    {

        $data = \request()->validate(
            [
                'invoice_id' => 'required',
                'remarks' => '',
                'totalAmount' => 'required',
                'discount' => 'required',
                'payableAmount' => 'required',
            ]
        );
        $data['user_id']=Auth::user()->id;
        return ReturnInvoice::create($data)->invoice_id;
    }
}
