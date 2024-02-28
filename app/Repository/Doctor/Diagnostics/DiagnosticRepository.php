<?php

namespace App\Repository\Doctor\Diagnostics;

use App\Interfaces\Doctor\Diagnostics\DiagnosticRepositoryInterface;
use App\Models\Diagnostic;
use App\Models\Invoice;
use App\Models\Ray;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DiagnosticRepository implements DiagnosticRepositoryInterface
{

    /**
     *
     * @param mixed $request
     */
    function store($request)
    {
        DB::beginTransaction();
        try {
        Diagnostic::create([
            'date' => Carbon::now(),
            'diagnosis' => $request->diagnosis,
            'medicine' => $request->medicine,
            'invoice_id' => $request->invoice_id,
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
        ]);
        $this->invoiceStatus($request->invoice_id,3);
            DB::commit();
        session()->flash('add');
        return redirect()->back();
    } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    function addReview($request)
    {
        DB::beginTransaction();
        try {
        Diagnostic::create([
            'date' => Carbon::now(),
                'review_date' => date('Y-m-d H:i:s'),
            'diagnosis' => $request->diagnosis,
            'medicine' => $request->medicine,
            'invoice_id' => $request->invoice_id,
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
        ]);
        $this->invoiceStatus($request->invoice_id,2);
            DB::commit();
        session()->flash('add');
        return redirect()->back();
    } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**
     *
     * @param mixed $id
     */
    function show($id) {
        $patient_records = Diagnostic::where('patient_id', $id)->get();
        $patient_rays = Ray::where('patient_id', $id)->get();
        return view('Dashboard.DoctorAuth.Invoices.patient_record',get_defined_vars());
    }
    public function invoiceStatus($invoice_id,$status)
    {
        Invoice::findOrFail($invoice_id)->update([
            'invoice_status' => $status
        ]);
    }
}
