<?php

namespace App\Http\Controllers\Patients;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Laboratory;
use App\Models\Ray;
use App\Models\ReceiptAccount;
use Illuminate\Http\Request;

class PatientDashboardController extends Controller
{
    public function invoices()
    {

        $invoices = Invoice::where('patient_id', auth()->user()->id)->get();
        return view('Dashboard.Patient_Dashboard.invoices', compact('invoices'));
    }

    public function laboratories()
    {

        $laboratories = Laboratory::where('patient_id', auth()->user()->id)->get();
        return view('Dashboard.Patient_Dashboard.laboratories', compact('laboratories'));
    }

    public function viewLaboratories($id)
    {

        $laboratorie = Laboratory::findOrFail($id);
        if ($laboratorie->patient_id != auth()->user()->id) {
            return redirect()->route('404');
        }
        return view('Dashboard.LaboratoryEmployeesDashboard.LaboratoryInvoices.patient_details', compact('laboratorie'));
    }

    public function rays()
    {

        $rays = Ray::where('patient_id', auth()->user()->id)->get();
        return view('Dashboard.Patient_Dashboard.rays', compact('rays'));
    }

    public function viewRays($id)
    {
        $rays = Ray::findOrFail($id);
        if ($rays->patient_id != auth()->user()->id) {
            return redirect()->route('404');
        }
        return view('Dashboard.Rays_Dashboard.invoices.patient_details', compact('rays'));
    }

    public function payments()
    {

        $payments = ReceiptAccount::where('patient_id', auth()->user()->id)->get();
        return view('Dashboard.Patient_Dashboard.payments', compact('payments'));
    }
}
