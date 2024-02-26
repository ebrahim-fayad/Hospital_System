<?php

namespace App\Livewire\Dashboard\Invoices\InvoicesGroup;

use App\Models\Invoice;
use Livewire\Attributes\On;
use Livewire\Component;

class InvoicesGroupDelete extends Component
{
    public $invoice_group_id;
    #[On('delete')]
    public function delete($id)
    {
        $this->invoice_group_id=$id;
       $this->dispatch('deleteModal');
    }
    public function destroy()
    {
        Invoice::destroy($this->invoice_group_id);
        $this->dispatch('deleteModal');
        session()->flash('delete');
        return to_route('invoices_Group');
    }
    public function render()
    {
        return view('Dashboard.Invoices.InvoicesGroup.invoices-group-delete');
    }
}
