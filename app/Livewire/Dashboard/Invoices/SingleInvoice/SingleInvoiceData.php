<?php

namespace App\Livewire\Dashboard\Invoices\SingleInvoice;

use App\Models\Invoice;

use Livewire\Component;

class SingleInvoiceData extends Component
{
    protected $listeners = ['refreshData'=>'$refresh'];
    // #[On('refreshData')]
    // public function refreshData()
    // {
    //     dd('test');
    // }

    public function render()
    {
        return view('Dashboard.Invoices.SingleInvoice.single-invoice-data',[
            'single_invoices'=>Invoice::where('invoice_type',1)->get(),
        ]);
    }
}
