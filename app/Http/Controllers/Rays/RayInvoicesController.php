<?php

namespace App\Http\Controllers\Rays;

use App\Http\Controllers\Controller;
use App\Interfaces\Rays\RayInvoicesRepositoryInterface;
use Illuminate\Http\Request;

class RayInvoicesController extends Controller
{
    private $Rays;
    public function __construct(RayInvoicesRepositoryInterface $Rays) {
        $this->Rays = $Rays;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Rays->index();
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
        return $this->Rays->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         return $this->Rays->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
