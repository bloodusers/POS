<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\InvoiceItem;
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
}
