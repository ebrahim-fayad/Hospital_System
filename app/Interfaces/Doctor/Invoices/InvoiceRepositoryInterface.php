<?php
namespace App\Interfaces\Doctor\Invoices;
interface InvoiceRepositoryInterface{
    public function index();
    public function show($id);
    public function edit($id);
    // Get reviewInvoices Doctor
    public function reviewInvoices();

    // Get completedInvoices Doctor
    public function completedInvoices();
}
