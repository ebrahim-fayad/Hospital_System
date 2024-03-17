<?php

namespace App\Repository\Doctor\Invoices;

use App\Interfaces\Doctor\Invoices\InvoiceRepositoryInterface;
use App\Models\Doctor;
use App\Models\Image;
use App\Models\Laboratory;
use App\Models\Ray;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InvoiceRepository implements InvoiceRepositoryInterface
{

    /**
     */
    function index()
    {
        $doctor = Doctor::findOrFail(auth()->user()->id);
        $invoices = $doctor->invoices()->where('invoice_status', 1)->get();
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
    /**
     *
     * @param mixed $id
     */
    function show($id)
    {
        $rays = Ray::findOrFail($id);
        if ($rays->doctor_id != auth()->user()->id) {
            // abort(404);
            return redirect()->route('404');
        }
        return view('Dashboard.DoctorAuth.Invoices.view_rays', compact('rays'));
    }
    function laboratoryInvoice($id)
    {
        $laboratorie = Laboratory::findOrFail($id);
        if ($laboratorie->laboratory_employee_id != auth()->user()->id) {
            return redirect()->route('404');
        }
        return view('Dashboard.LaboratoryEmployeesDashboard.LaboratoryInvoices.patient_details', compact('laboratorie'));
    }
    /**
     *
     * @param mixed $id
     */
    function edit($id)
    {
        $image = Image::findOrFail($id);
        $file = Storage::disk('upload_image')->path("$image->fileName");
        // $file = Storage::path('Dashboard/img/'.$image->fileName);
        return response()->download($file);
    }
}
