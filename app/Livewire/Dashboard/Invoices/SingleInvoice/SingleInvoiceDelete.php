<?php

namespace App\Livewire\Dashboard\Invoices\SingleInvoice;

use App\Models\Invoice;
use Livewire\Attributes\On;
use Livewire\Component;

class SingleInvoiceDelete extends Component
{
    public $single_invoice_id;
    #[On('delete')]
    public function delete($id)
    {
        $this->single_invoice_id = $id;
        $this->dispatch('deleteModal');
    }
    public function destroy()
    {
        Invoice::destroy($this->single_invoice_id);
        $this->dispatch('deleteModal');
        session()->flash('delete');
        return to_route('single_invoice');
    }
    public function render()
    {
        return view('Dashboard.Invoices.SingleInvoice.single-invoice-delete');
    }
}
