<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAccount extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function singleInvoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function groupInvoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function
    Receipt()
    {
        return $this->belongsTo(ReceiptAccount::class);
    }
    public function Payment()
    {
        return $this->belongsTo(PaymentAccount::class, 'Payment_id');
    }
}
