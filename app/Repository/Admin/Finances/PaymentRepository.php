<?php

namespace App\Repository\Admin\Finances;



use App\Interfaces\Admin\Finances\PaymentRepositoryInterface;
use App\Models\FundAccount;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\PaymentAccount;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentRepository implements PaymentRepositoryInterface
{

    /**
     */
    function index()
    {
        $payments = PaymentAccount::all();
        return view('Dashboard.Payments.index', compact('payments'));
    }
    /**
     */
    function create()
    {
        $Patients = Patient::all();
        return view('Dashboard.Payments.add', compact('Patients'));
    }
    // /**
    //  *
    //  * @param mixed $request
    //  */
    function store($request)
    {
        DB::beginTransaction();
        try {
            //store in payment_accounts table
            $payment_accounts = PaymentAccount::create([
                'date' => Carbon::now(),
                'patient_id' => $request->patient_id,
                'amount' => $request->Debit,
                'description' => $request->description
            ]);
            //store in  fund_accounts table
            FundAccount::create([
                'date' => Carbon::now(),
                'Payment_id' => $payment_accounts->id,
                'credit' => $request->Debit,
                'Debit' => 0.00,
            ]);
            //store in Patients Account
            PatientAccount::create([
                'date' => Carbon::now(),
                'patient_id' => $request->patient_id,
                'Payment_id' => $payment_accounts->id,
                'credit' => 0.00,
                'Debit' => $request->Debit,
            ]);
            DB::commit();
            session()->flash('add');
            return to_route('Payment.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**
     *
     * @param mixed $id
     */
    function edit($id)
    {
        $Payment = PaymentAccount::findOrFail($id);
        $Patients = Patient::all();
        return view('Dashboard.Payments.edit', compact('Payment', 'Patients'));
    }
    /**
     *
     * @param mixed $request
     * @param mixed $id
     */
    function update($request, $id)
    {
        DB::beginTransaction();
        try {
            //update in receipt_accounts table
            $payment_accounts = PaymentAccount::findOrFail($id);
            $payment_accounts->update([
                'date' => Carbon::now(),
                'patient_id' => $request->patient_id,
                'amount' => $request->Debit,
                'description' => $request->description
            ]);
            //update in  fund_accounts table
            $FundAccount = FundAccount::where('Payment_id', $id)->first();
            $FundAccount->update([
                'date' => Carbon::now(),
                'Payment_id' => $payment_accounts->id,
                'credit' => $request->Debit,
                'Debit' => 0.00,
            ]);
            //update in Patients Account
            $PatientAccount = PatientAccount::where('Payment_id', $id)->first();
            $PatientAccount->update([
                'date' => Carbon::now(),
                'patient_id' => $request->patient_id,
                'Payment_id' => $payment_accounts->id,
                'Debit' => $request->Debit,
                'credit' => 0.00,
            ]);
            DB::commit();
            session()->flash('edit');
            return to_route('Payment.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**
     *
     * @param mixed $id
     */
    function destroy($id)
    {
        PaymentAccount::destroy($id);
        session()->flash('delete');
        return to_route('Receipt.index');
    }
    /**
     *
     * @param mixed $id
     */
    function show($id) {
        $payment_account = PaymentAccount::findOrFail($id);
        return view('Dashboard.Payments.print', compact('payment_account'));
    }
}
