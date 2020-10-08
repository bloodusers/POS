<?php

namespace App\Http\Controllers;

use App\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        $data = \request()->validate(
            [
                'invoice_id' => 'required',
                'item_id' => 'required',
                'qty' => 'required',
            ]
        );
         $invItem=InvoiceItem::where('invoice_id',$data['invoice_id'])->where('item_id',$data['item_id'])->first()->id;
         InvoiceItem::find($invItem)->update(['returnQty'=>InvoiceItem::find($invItem)->returnQty+$data['qty']]);
         return $invItem;
    }
}
