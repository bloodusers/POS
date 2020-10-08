<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\InvoiceItem;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceItemController extends Controller
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
                'item_id' => '',
                'qty' => 'required',
                'price' => 'required',
                'returnQty' => 'required',
            ]
        );
        return InvoiceItem::create($data)->id;
        return $data;
    }
    public function getItems($invId)
    {
        $data=Invoice::find($invId)->invoiceItems;
        $arr=array();
        foreach ($data as $iItem)
        {
            $obj=Item::find($iItem->item_id);
            $obj['qty']=$iItem->qty-$iItem->returnQty;
            array_push($arr,$obj);
        }
        //dd($arr);
       return $arr;
    }
}
