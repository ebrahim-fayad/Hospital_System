<?php

namespace App\Http\Controllers\Laboratories;

use App\Http\Controllers\Controller;
use App\Interfaces\Laboratories\LaboratoryInvoicesRepositoryInterface;
use Illuminate\Http\Request;

class LaboratoryInvoiceController extends Controller
{
    private $Laboratory;
    public function __construct(LaboratoryInvoicesRepositoryInterface $Laboratory) {
        $this->Laboratory = $Laboratory;
    }
    public function index()
    {
        return $this->Laboratory->index();
    }
    public function completedRayInvoices()
    {
        return $this->Laboratory->completedRayInvoices();
    }
    public function view_laboratories($id)
    {
        return $this->Laboratory->view_laboratories($id);
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
        return $this->Laboratory->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        return $this->Laboratory->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->Laboratory->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
