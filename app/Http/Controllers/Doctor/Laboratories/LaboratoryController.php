<?php

namespace App\Http\Controllers\Doctor\Laboratories;

use App\Http\Controllers\Controller;
use App\Interfaces\Doctor\Laboratories\LaboratoryRepositoryInterface;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    private $Laboratory;
    public function __construct(LaboratoryRepositoryInterface $Laboratory) {
        $this->Laboratory = $Laboratory;
    }
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
        return $this->Laboratory->store($request);
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
    public function update(Request $request,  $id)
    {
        return $this->Laboratory->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Laboratory->destroy($id);
    }
}
