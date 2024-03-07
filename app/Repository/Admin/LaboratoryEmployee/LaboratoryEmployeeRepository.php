<?php

namespace App\Repository\Admin\LaboratoryEmployee;

use App\Interfaces\Admin\LaboratoryEmployee\LaboratoryEmployeeRepositoryInterface;
use App\Models\LaboratoryEmployee;
use App\Traits\UploadTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LaboratoryEmployeeRepository implements LaboratoryEmployeeRepositoryInterface
{
    use UploadTrait;

    /**
     */
    function index()
    {
        $Laboratory_Employees = LaboratoryEmployee::all();
        return view('Dashboard.LaboratoryEmployee.index', compact('Laboratory_Employees'));
    }
    /**
     *
     * @param mixed $request
     */
    function store($request)
    {
        DB::beginTransaction();
        try {
            $LaboratoryEmployee = LaboratoryEmployee::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $this->uploadImage($request, 'upload_image', 'photo', 'LaboratoryEmployees', $LaboratoryEmployee->id, 'App\Models\LaboratoryEmployee');
            DB::commit();
            session()->flash('add');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**
     *
     * @param mixed $request
     * @param mixed $id
     */
    function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $LaboratoryEmployee = LaboratoryEmployee::findOrFail($id);
            $input = $request->all();
            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
                $input = Arr::except($input, ['photo']);
            } else {
                $input = Arr::except($input, ['password','photo']);
            }
            $LaboratoryEmployee->update($input);
            if ($request->photo) {
                $this->deleteImage('upload_image', $LaboratoryEmployee->id, 'App\Models\LaboratoryEmployee');
                $this->uploadImage($request, 'upload_image', 'photo', 'LaboratoryEmployees', $LaboratoryEmployee->id, 'App\Models\LaboratoryEmployee');
            }
             DB::commit();
            session()->flash('edit');
            return to_route('Laboratory_Employee.index');
        } catch (\Exception $e) {
           DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     *
     * @param mixed $id
     */
    function destroy($id)
    {
        $this->deleteImage('upload_image', $id, 'App\Models\LaboratoryEmployee');
        LaboratoryEmployee::destroy($id);
        session()->flash('delete');
        return redirect()->back();
    }
}
