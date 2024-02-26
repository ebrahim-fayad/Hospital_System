<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundAccount extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function singleInvoice()
    {
        return $this->belongsTo(SingleInvoice::class);
    }
    public function Receipt()
    {
        return $this->belongsTo(ReceiptAccount::class);
    }
    public function Payment()
    {
        return $this->belongsTo(PaymentAccount::class);
    }
}
