<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnInvoice extends Model
{
    protected $guarded=[];
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
