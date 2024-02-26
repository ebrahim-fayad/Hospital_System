<?php

namespace App\Livewire\Dashboard\Invoices\InvoicesGroup;

use App\Models\Invoice;
use Livewire\Component;

class InvoicesGroupData extends Component
{
    public function render()
    {
        return view('Dashboard.Invoices.InvoicesGroup.invoices-group-data',[
            'group_invoices'=>Invoice::where('invoice_type',2)->get(),
        ]);
    }
}
