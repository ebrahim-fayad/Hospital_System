<?php

namespace App\Repository\Doctor\Invoices;

use App\Interfaces\Doctor\Invoices\InvoiceRepositoryInterface;
use App\Models\Doctor;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InvoiceRepository implements InvoiceRepositoryInterface
{

    /**
     */
    function index()
    {
        $doctor = Doctor::findOrFail(auth()->user()->id);
        $invoices = $doctor->invoices()->where('invoice_status',1)->get();
        return view('Dashboard.DoctorAuth.Invoices.index', compact('invoices'));
    }
    public function reviewInvoices()
    {
        $doctor = Doctor::findOrFail(auth()->user()->id);
        $invoices = $doctor->invoices()->where('invoice_status', 2)->get();
        return view('Dashboard.DoctorAuth.Invoices.review_invoices', compact('invoices'));
    }

    // قائمة الفواتير المكتملة
    public function completedInvoices()

    {
        $doctor = Doctor::findOrFail(auth()->user()->id);
        $invoices = $doctor->invoices()->where('invoice_status', 3)->get();
        return view('Dashboard.DoctorAuth.Invoices.completed_invoices', compact('invoices'));
    }
}
