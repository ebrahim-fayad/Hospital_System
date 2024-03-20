<?php

namespace App\Livewire\Dashboard\Invoices\InvoicesGroup;

use App\Events\PatientAppointmentCreate;
use App\Models\Doctor;
use App\Models\FundAccount;
use App\Models\Group;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\SectionTranslation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InvoicesGroupCreate extends Component
{
    public $tax_rate = 17;
    public $price, $discount_value = 0, $patient_id, $doctor_id, $section_id, $type, $Group_id, $tax_value = 0, $subtotal, $Total_after_discount;
    public function get_section()
    {
        $doctor = Doctor::findOrFail($this->doctor_id);
        $this->section_id = $doctor->section->name;
    }
    public function get_price()
    {
        $this->price = Group::where('id', $this->Group_id)->first()->Total_with_tax;
    }
    public function render()
    {
        $this->Total_after_discount = (is_numeric($this->price) ? $this->price  : 0) - (is_numeric($this->discount_value) ? $this->discount_value : 0);
        $this->tax_value = $this->Total_after_discount * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
        $this->subtotal = ((is_numeric($this->Total_after_discount) ? $this->Total_after_discount : 0)) + ((is_numeric($this->tax_value) ? $this->tax_value : 0));
        return view('Dashboard.Invoices.InvoicesGroup.invoices-group-create', [
            'Patients' => Patient::all(),
            'Doctors' => Doctor::all(),
            'Groups' => Group::all(),
        ]);
    }
    public function store()
    {
        // $this->validate();
        DB::beginTransaction();
        try {
            $this->section_id = SectionTranslation::where('name', $this->section_id)->first()->section_id;
            if ($this->type == 1) {
                $InvoiceGroup =   Invoice::create([
                    'invoice_type' => 2,
                    'invoice_date' => Carbon::now(),
                    'patient_id' => $this->patient_id,
                    'doctor_id' => $this->doctor_id,
                    'section_id' => $this->section_id,
                    'Group_id' => $this->Group_id,
                    'price' => $this->price,
                    'discount_value' => $this->discount_value,
                    'tax_rate' => $this->tax_rate,
                    'tax_value' => $this->tax_value,
                    'total_with_tax' => $this->subtotal,
                    'type' => $this->type,
                ]);
                FundAccount::create([
                    'invoice_id' => $InvoiceGroup->id,
                    'date' => Carbon::now(),
                    'Debit' => $this->subtotal,
                    'credit' => '0.00'
                ]);

                // $this->dispatch('refreshData')->to(InvoiceGroup$InvoiceGroupData::class);
            } else {
                $InvoiceGroup =   Invoice::create([
                    'invoice_type' => 2,
                    'invoice_date' => date('Y-m-d'),
                    'patient_id' => $this->patient_id,
                    'doctor_id' => $this->doctor_id,
                    'section_id' => $this->section_id,
                    'Group_id' => $this->Group_id,
                    'price' => $this->price,
                    'discount_value' => $this->discount_value,
                    'tax_rate' => $this->tax_rate,
                    'tax_value' => $this->tax_value,
                    'total_with_tax' => $this->subtotal,
                    'type' => $this->type,
                ]);
                PatientAccount::create([
                    'date' => Carbon::now(),
                    'invoice_id' => $InvoiceGroup->id,
                    'patient_id' => $this->patient_id,
                    'Debit' => $this->subtotal,
                    'credit' => 0.00
                ]);
            }
            $data = [
                'name' => 'test',
                'doctor' => $this->doctor_id,
                'section' => $this->section_id,
            ];
            event(new PatientAppointmentCreate($data));
            DB::commit();
            $this->dispatch('create');
            session()->flash('add');

            // session()->flash('add');
            $this->reset('patient_id', 'price', 'discount_value', 'doctor_id', 'section_id', 'type', 'Group_id', 'tax_value', 'subtotal', 'Total_after_discount');
            return redirect()->route('invoices_Group');
            // return to_route('single_invoice');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
            // return redirect()->route('single_invoice')->withErrors([$e->getMessage()]);
            return redirect()->route('invoices_Group');
        }
    }
}
