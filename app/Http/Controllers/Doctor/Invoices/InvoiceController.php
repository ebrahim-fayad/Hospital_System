<?php

namespace App\Http\Controllers\Doctor\Invoices;

use App\Http\Controllers\Controller;
use App\Interfaces\Doctor\Invoices\InvoiceRepositoryInterface;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    private $Invoice;
    public function __construct(InvoiceRepositoryInterface $Invoice)
    {
        $this->Invoice = $Invoice;
    }
    public function index()
    {
        return  $this->Invoice->index();
    }
    public function reviewInvoices()
    {
        return $this->Invoice->reviewInvoices();
    }

    public function completedInvoices()
    {
        return $this->Invoice->completedInvoices();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
