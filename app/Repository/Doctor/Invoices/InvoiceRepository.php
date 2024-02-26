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
        $invoices = $doctor->invoices()->get();
        return view('Dashboard.DoctorAuth.Invoices.index', compact('invoices'));
    }
}
