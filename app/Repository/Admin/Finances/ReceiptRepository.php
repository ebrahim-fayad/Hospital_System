<?php

namespace App\Repository\Admin\Finances;


use App\Interfaces\Admin\Finances\ReceiptRepositoryInterface;
use App\Models\FundAccount;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReceiptRepository implements ReceiptRepositoryInterface
{

    /**
     */
    function index()
    {
        $receipts = ReceiptAccount::all();
        return view('Dashboard.Receipts.index', compact('receipts'));
    }
    /**
     */
    function create()
    {
        $Patients = Patient::all();
        return view('Dashboard.Receipts.add', compact('Patients'));
    }
    /**
     *
     * @param mixed $request
     */
    function store($request)
    {
        DB::beginTransaction();
        try {
            //store in receipt_accounts table
            $receipt_accounts = ReceiptAccount::create([
                'date' => Carbon::now(),
                'patient_id' => $request->patient_id,
                'amount' => $request->Debit,
                'description' => $request->description
            ]);
            //store in  fund_accounts table
            FundAccount::create([
                'date' => Carbon::now(),
                'receipt_account_id' => $receipt_accounts->id,
                'Debit' => $request->Debit,
                'credit' => 0.00,
            ]);
            //store in Patients Account
            PatientAccount::create([
                'date' => Carbon::now(),
                'patient_id' => $request->patient_id,
                'receipt_id' => $receipt_accounts->id,
                'Debit' => 0.00,
                'credit' => $request->Debit,
            ]);
            DB::commit();
            session()->flash('add');
            return to_route('Receipt.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**
     *
     * @param mixed $id
     */
    function edit($id) {
        $receipt = ReceiptAccount::findOrFail($id);
        $Patients = Patient::all();
        return view('Dashboard.Receipts.edit', compact('receipt', 'Patients'));
    }
    /**
     *
     * @param mixed $request
     * @param mixed $id
     */
    function update($request, $id) {
        DB::beginTransaction();
        try {
            //store in receipt_accounts table
            $receipt_accounts = ReceiptAccount::findOrFail($id);
            $receipt_accounts->update([
                'date' => Carbon::now(),
                'patient_id' => $request->patient_id,
                'amount' => $request->Debit,
                'description' => $request->description
            ]);
            //store in  fund_accounts table
            $FundAccount = FundAccount::where('receipt_account_id', $id)->first();
            $FundAccount->update([
                'date' => Carbon::now(),
                'receipt_account_id' => $receipt_accounts->id,
                'Debit' => $request->Debit,
                'credit' => 0.00,
            ]);
            //store in Patients Account
            $PatientAccount = PatientAccount::where('receipt_id', $id)->first();
            $PatientAccount->update([
                'date' => Carbon::now(),
                'patient_id' => $request->patient_id,
                'receipt_id' => $receipt_accounts->id,
                'Debit' => 0.00,
                'credit' => $request->Debit,
            ]);
            DB::commit();
            session()->flash('edit');
            return to_route('Receipt.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**
     *
     * @param mixed $id
     */
    function destroy($id) {
        ReceiptAccount::destroy($id);
        session()->flash('delete');
        return to_route('Receipt.index');
    }
    /**
     *
     * @param mixed $id
     */
    function show($id) {
        $receipt = ReceiptAccount::findOrFail($id);
        return view('Dashboard.Receipts.print', compact('receipt'));
    }
}
