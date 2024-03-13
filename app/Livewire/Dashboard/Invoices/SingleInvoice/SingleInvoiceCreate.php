<?php

namespace App\Livewire\Dashboard\Invoices\SingleInvoice;

use App\Events\CreateInvoice;
use App\Models\Doctor;
use App\Models\FundAccount;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\SectionTranslation;
use App\Models\Service;
use App\Notifications\CreateGroupInvoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class SingleInvoiceCreate extends Component
{
    public $tax_rate = 17;
    public $price, $discount_value = 0, $patient_id, $doctor_id, $section_id, $type, $Service_id, $tax_value = 0, $subtotal, $Total_after_discount;
    protected $rules = [
        'patient_id' => 'required',
        // 'email' => 'required|email',
    ];
    public function render()
    {
        $this->Total_after_discount = (is_numeric($this->price) ? $this->price  : 0) - (is_numeric($this->discount_value) ? $this->discount_value : 0);
        $this->tax_value = number_format($this->Total_after_discount * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100));
        $this->subtotal = ((is_numeric($this->Total_after_discount) ? $this->Total_after_discount : 0)) + ((is_numeric($this->tax_value) ? $this->tax_value : 0));
        return view('Dashboard.Invoices.SingleInvoice.single-invoice-create', [
            'Patients' => Patient::all(),
            'Doctors' => Doctor::all(),
            'Services' => Service::all(),
        ]);
    }
    public function get_section()
    {
        $doctor = Doctor::findOrFail($this->doctor_id);
        $this->section_id = $doctor->section->name;
    }
    public function get_price()
    {
        $this->price = Service::where('id', $this->Service_id)->first()->price;
    }

    public function store()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            $this->section_id = SectionTranslation::where('name', $this->section_id)->first()->section_id;
            if ($this->type == 1) {
                $singleInvoice =   Invoice::create([
                    'invoice_type'=>1,
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
                FundAccount::create([
                    'invoice_id' => $singleInvoice->id,
                    'date' => Carbon::now(),
                    'Debit' => $this->subtotal,
                    'credit' => '0.00'
                ]);

                // $this->dispatch('refreshData')->to(SingleInvoiceData::class);
            } else {
                $singleInvoice =   Invoice::create([
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
                PatientAccount::create([
                    'date' => Carbon::now(),
                    'invoice_id' => $singleInvoice->id,
                    'patient_id' => $this->patient_id,
                    'Debit' => $this->subtotal,
                    'credit' => 0.00
                ]);
            }
            $data = [
                'patient' => $this->patient_id,
                'invoice_id' => $singleInvoice->id,
                'doctor_id' => $this->doctor_id,
            ];

            event(new CreateInvoice($data));
            $users = Doctor::findOrFail($this->doctor_id);
            Notification::send($users, new CreateGroupInvoice($singleInvoice->name, $singleInvoice->id));
            DB::commit();
            $this->dispatch('create');
            session()->flash('add');

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
