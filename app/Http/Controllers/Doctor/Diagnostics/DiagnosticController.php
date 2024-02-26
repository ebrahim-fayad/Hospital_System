<?php

namespace App\Http\Controllers\Doctor\Diagnostics;

use App\Http\Controllers\Controller;
use App\Interfaces\Doctor\Diagnostics\DiagnosticRepositoryInterface;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{
    private $Diagnostic;
    public function __construct(DiagnosticRepositoryInterface $Diagnostic)
    {
        $this->Diagnostic = $Diagnostic;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        return $this->Diagnostic->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        return $this->Diagnostic->show($id);
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
