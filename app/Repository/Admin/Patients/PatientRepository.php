<?php

namespace App\Repository\Admin\Patients;


use App\Interfaces\Admin\Patients\PatientRepositoryInterface;
use App\Models\Gender;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientRepository implements PatientRepositoryInterface
{
    public function index()
    {
        $Patients = Patient::all();
        return view('Dashboard.Patients.index', compact('Patients'));
    }
    public function create()
    {
        $genders = Gender::all();
        return view('Dashboard.Patients.create', compact('genders'));
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            Patient::create([
                'name' => $request->name,
                'email' => $request->email,
                'Phone' => $request->Phone,
                'password' => Hash::make($request->Phone),
                'Date_Birth' => $request->Date_Birth,
                'gender_id' => $request->gender_id,
                'Blood_Group' => $request->Blood_Group,
                'Address' => $request->Address,
            ]);
            DB::commit();
            session()->flash('add');
            return to_route('Patients.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $Patient = Patient::findOrFail($id);
        $genders = Gender::all();
        return view('Dashboard.Patients.edit', compact('Patient', 'genders'));
    }
    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            Patient::findOrFail($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'Phone' => $request->Phone,
                'password' => Hash::make($request->Phone),
                'Date_Birth' => $request->Date_Birth,
                'gender_id' => $request->gender_id,
                'Blood_Group' => $request->Blood_Group,
                'Address' => $request->Address,
            ]);
            DB::commit();
            session()->flash('edit');
            return to_route('Patients.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        Patient::destroy($id);
        session()->flash('delete');
        return to_route('Patients.index');
    }
    /**
     *
     * @param mixed $id
     */
    function show($id)
    {
        $Patient = patient::findOrFail($id);
        $invoices = Invoice::where('patient_id', $id)->get();
        $receipt_accounts = ReceiptAccount::where('patient_id', $id)->get();
        $Patient_accounts = PatientAccount::where('patient_id', $id)->get();
        return view('Dashboard.Patients.Details', compact('Patient', 'invoices', 'receipt_accounts', 'Patient_accounts'));
    }
}
