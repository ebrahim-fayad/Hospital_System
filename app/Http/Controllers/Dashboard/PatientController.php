<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PatientRequest;
use App\Interfaces\Admin\Patients\PatientRepositoryInterface;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    private $Patient;
    public function __construct(PatientRepositoryInterface $Patient)
    {
        $this->Patient = $Patient;
    }
    public function index()
    {
        return $this->Patient->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Patient->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatientRequest $request)
    {
        return $this->Patient->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        return $this->Patient->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        return $this->Patient->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatientRequest $request,  $id)
    {
        return $this->Patient->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Patient->destroy($id);
    }
}
