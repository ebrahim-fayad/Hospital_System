<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\DoctorRequest;
use App\Interfaces\Admin\Doctors\DoctorRepositoryInterface;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    private $doctors;
    public function __construct(DoctorRepositoryInterface $doctors)
    {
       $this->doctors = $doctors;
    }

    public function index()
    {
        return $this->doctors->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->doctors->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorRequest $request)
    {
        return $this->doctors->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->doctors->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DoctorRequest $request, $id)
    {
        return $this->doctors->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
        return $this->doctors->destroy($request , $id);
    }
    public function update_password(Request $request,$id)
    {
        $validated = $request->validate([
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);
        return $this->doctors->update_password($request , $id);
    }
    public function update_status(Request $request,$id)
    {
        $validated = $request->validate([
            'status' => 'required|in:0,1',

        ]);

        return $this->doctors->update_status($request , $id);
    }
}
