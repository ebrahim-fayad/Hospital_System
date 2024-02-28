<?php

namespace App\Http\Controllers\Doctor\Rays;

use App\Http\Controllers\Controller;
use App\Interfaces\Doctor\Rays\RayRepositoryInterface;
use Illuminate\Http\Request;

class RayController extends Controller
{
    private $Ray;
    public function __construct(RayRepositoryInterface $Ray)
    {
        $this->Ray = $Ray;
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
        return $this->Ray->store($request);
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
        return $this->Ray->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Ray->destroy($id);
    }
}
