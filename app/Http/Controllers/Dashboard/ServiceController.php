<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreSingleServiceRequest;
use App\Interfaces\Admin\Services\ServiceRepositoryInterface;
use App\Models\Service;


class ServiceController extends Controller
{
    private $service;
    public function __construct(ServiceRepositoryInterface $service)
    {
        $this->service=$service;
    }
    public function index()
    {
        return $this->service->index();
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
    public function store(StoreSingleServiceRequest $request)
    {
        return $this->service->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSingleServiceRequest $request,$id)
    {
        return $this->service->update($request , $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->service->destroy( $id);
    }
}
