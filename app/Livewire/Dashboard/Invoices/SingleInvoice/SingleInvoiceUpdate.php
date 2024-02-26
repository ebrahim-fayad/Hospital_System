<?php

namespace App\Livewire\Dashboard\Invoices\SingleInvoice;

use App\Models\Doctor;
use App\Models\FundAccount;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\SectionTranslation;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class SingleInvoiceUpdate extends Component
{
    public $single_invoice, $tax_rate, $price, $discount_value, $patient_id, $doctor_id, $section_id, $type, $Service_id, $tax_value, $subtotal, $Total_after_discount;
    // protected $listeners = ['update'];
    #[On('update')]
    public function update($id)
    {
        $this->single_invoice = $id;
        $single_invoice = Invoice::findOrFail($id);
        $this->patient_id = $single_invoice->patient_id;
        $this->doctor_id = $single_invoice->doctor_id;
        //لي معرفة اسم القسم التابع له الطبيب
        $doctor = Doctor::findOrFail($this->doctor_id);
        $this->section_id = $doctor->section->name;
        //#################################
        $this->type = $single_invoice->type;
        $this->Service_id = $single_invoice->Service_id;
        $this->price = Service::findOrFail($this->Service_id)->price;
        $this->discount_value = $single_invoice->discount_value;
        $this->tax_rate = $single_invoice->tax_rate;
        $this->tax_value = $single_invoice->tax_value;
        $this->subtotal = $single_invoice->total_with_tax;
        $this->dispatch('updateModal');
    }
    public function get_section()
    {
        $doctor = Doctor::findOrFail($this->doctor_id);
        $this->section_id = $doctor->section->name;
    }
    public function get_price()
    {
        $this->price = Service::where('id', $this->Service_id)->first()->price;
        $this->Total_after_discount = $this->price - $this->discount_value;
        $this->tax_value = $this->Total_after_discount * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
        $this->subtotal =  number_format(((is_numeric($this->Total_after_discount) ? $this->Total_after_discount : 0)) + ((is_numeric($this->tax_value) ? $this->tax_value : 0)), 2);
    }


    public function render()
    {
        $this->Total_after_discount = (is_numeric($this->price) ? $this->price  : 0) - (is_numeric($this->discount_value) ? $this->discount_value : 0);
        $this->tax_value = number_format($this->Total_after_discount * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100));
        $this->subtotal = ((is_numeric($this->Total_after_discount) ? $this->Total_after_discount : 0)) + ((is_numeric($this->tax_value) ? $this->tax_value : 0));
        return view('Dashboard.Invoices.SingleInvoice.single-invoice-update', [
            'Patients' => Patient::all(),
            'Doctors' => Doctor::all(),
            'Services' => Service::all(),
        ]);
    }
    public function store()
    {
        // $this->validate();
        DB::beginTransaction();
        try {
            $this->section_id = SectionTranslation::where('name', $this->section_id)->first()->section_id;
            if ($this->type == 1) {
                Invoice::findOrFail($this->single_invoice)->update([
                    'invoice_type' => 1,
                    'invoice_date' => Carbon::now(),
                    'patient_id' => $this->patient_id,
                    'doctor_id' => $this->doctor_id,
                    'section_id' => $this->section_id,
                    'Service_id' => $this->Service_id,
                    'price' => $this->price,
                    'discount_value' => $this->discount_value,
                    'tax_rate' => $this->tax_rate,
                    'tax_value' => $this->tax_value,
                    'total_with_tax' => $this->subtotal,
                    'type' => $this->type,
                    'invoice_status' => 1
                ]);
                $FundAccount = FundAccount::where('invoice_id', $this->single_invoice)->first();
                $FundAccount->update([
                    'invoice_id' => $this->single_invoice,
                    'date' => Carbon::now(),
                    'Debit' => $this->subtotal,
                    'credit' => '0.00'
                ]);
            } else {
                Invoice::findOrFail($this->single_invoice)->update([
                    'invoice_type' => 1,
                    'invoice_date' => Carbon::now(),
                    'patient_id' => $this->patient_id,
                    'doctor_id' => $this->doctor_id,
                    'section_id' => $this->section_id,
                    'Service_id' => $this->Service_id,
                    'price' => $this->price,
                    'discount_value' => $this->discount_value,
                    'tax_rate' => $this->tax_rate,
                    'tax_value' => $this->tax_value,
                    'total_with_tax' => $this->subtotal,
                    'type' => $this->type,
                    'invoice_status' => 1
                ]);
                $PatientAccount = PatientAccount::where('invoice_id', $this->single_invoice)->first();
                $PatientAccount->update([
                    'date' => Carbon::now(),
                    'invoice_id' =>  $this->single_invoice,
                    'patient_id' => $this->patient_id,
                    'Debit' => $this->subtotal,
                    'credit' => 0.00
                ]);
            }
            DB::commit();
            $this->dispatch('updateModal');
            session()->flash('edit');

            // session()->flash('add');
            $this->reset('patient_id', 'price', 'discount_value', 'doctor_id', 'section_id', 'type', 'Service_id', 'tax_value', 'subtotal', 'Total_after_discount');
            return redirect()->route('single_invoice');
            // return to_route('single_invoice');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
            // return redirect()->route('single_invoice')->withErrors([$e->getMessage()]);
            return redirect()->route('single_invoice');
        }
    }
}
