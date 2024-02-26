<?php
namespace App\Interfaces\Doctor\Invoices;
interface InvoiceRepositoryInterface{
    public function index();
    // Get reviewInvoices Doctor
    public function reviewInvoices();

    // Get completedInvoices Doctor
    public function completedInvoices();
}
