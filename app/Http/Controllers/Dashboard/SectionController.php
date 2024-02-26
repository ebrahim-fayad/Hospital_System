<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SectionRequest;
use App\Interfaces\Admin\Sections\SectionRepositoryInterface;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    private $sections;

    public function __construct(SectionRepositoryInterface $sections)
    {
        $this->sections = $sections;
    }
    public function index()
    {

        return $this->sections->index();
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
    public function store(SectionRequest $request)
    {
        return $this->sections->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->sections->show($id);
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
    public function update(Request $request, $id)
    {
        return $this->sections->update($request , $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        return $this->sections->destroy($id);
    }
}
