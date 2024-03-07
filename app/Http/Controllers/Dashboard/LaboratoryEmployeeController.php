<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Interfaces\Admin\LaboratoryEmployee\LaboratoryEmployeeRepositoryInterface;
use Illuminate\Http\Request;

class LaboratoryEmployeeController extends Controller
{

    private $LaboratoryEmployee;
    public function __construct(LaboratoryEmployeeRepositoryInterface $LaboratoryEmployee)
    {
        $this->LaboratoryEmployee = $LaboratoryEmployee;
    }
    public function index()
    {
        return $this->LaboratoryEmployee->index();
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
        return $this->LaboratoryEmployee->store($request);
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
        return $this->LaboratoryEmployee->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->LaboratoryEmployee->destroy($id);
    }
}
