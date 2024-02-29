<?php
namespace App\Repository\Doctor\Laboratories;

use App\Interfaces\Doctor\Laboratories\LaboratoryRepositoryInterface;
use App\Models\Laboratory;
use Illuminate\Support\Facades\DB;

class LaboratoryRepository implements LaboratoryRepositoryInterface{

    /**
     *
     * @param mixed $request
     */
    function store($request) {
        $request->validate([
            'description' => 'required',
        ], [
            'description.required' => trans('validation.required')
        ]);
        DB::beginTransaction();
        try {
            Laboratory::create([
                'description' => $request->description,
                'invoice_id' => $request->invoice_id,
                'patient_id' => $request->patient_id,
                'doctor_id' => $request->doctor_id,
            ]);
            DB::commit();
            session()->flash('add');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }
    /**
     *
     * @param mixed $id
     */
    function destroy($id) {
        Laboratory::destroy($id);
        session()->flash('delete');
        return redirect()->back();
    }


    function update($request, $id) {
        $request->validate([
            'description' => 'required',
        ], [
            'description.required' => trans('validation.required')
        ]);
        DB::beginTransaction();
        try {
            Laboratory::findOrFail($id)->update([
                'description' => $request->description,
            ]);
            DB::commit();
            session()->flash('edit');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
