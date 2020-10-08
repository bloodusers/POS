<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnInvoiceItem extends Model
{
    protected $guarded=[];
    public function returnInvoice()
    {
        return $this->belongsTo(ReturnInvoice::class);
    }
}
