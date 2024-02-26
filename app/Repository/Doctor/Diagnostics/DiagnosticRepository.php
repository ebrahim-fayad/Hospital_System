<?php

namespace App\Repository\Doctor\Diagnostics;

use App\Interfaces\Doctor\Diagnostics\DiagnosticRepositoryInterface;
use App\Models\Diagnostic;
use Carbon\Carbon;

class DiagnosticRepository implements DiagnosticRepositoryInterface
{

    /**
     *
     * @param mixed $request
     */
    function store($request)
    {
        Diagnostic::create([
            'date' => Carbon::now(),
            'diagnosis' => $request->diagnosis,
            'medicine' => $request->medicine,
            'invoice_id' => $request->invoice_id,
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
        ]);
        session()->flash('add');
        return redirect()->back();
    }
    /**
     *
     * @param mixed $id
     */
    function show($id) {
        $patient_records = Diagnostic::where('patient_id', $id)->get();
        return view('Dashboard.DoctorAuth.Invoices.patient_record', compact('patient_records'));
    }
}
