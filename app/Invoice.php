<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    protected $guarded=[];
    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
