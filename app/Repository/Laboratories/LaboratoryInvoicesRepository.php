<?php
namespace App\Repository\Laboratories;
use App\Interfaces\Laboratories\LaboratoryInvoicesRepositoryInterface;
use App\Models\Image;
use App\Models\Laboratory;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LaboratoryInvoicesRepository implements LaboratoryInvoicesRepositoryInterface{
    use UploadTrait;
    /**
     */
    function index() {
        $invoices = Laboratory::where('case', 0)->get();
        return view('Dashboard.LaboratoryEmployeesDashboard.LaboratoryInvoices.index', get_defined_vars());
    }
    /**
     */
    function completedRayInvoices()
    {
        $invoices = Laboratory::where('case', 1)->get();
        return view('Dashboard.LaboratoryEmployeesDashboard.LaboratoryInvoices.completed_invoices', get_defined_vars());
    }

    /**
     *
     * @param mixed $request
     */
    function edit($id) {
        $invoice = Laboratory::findOrFail($id);
        return view('Dashboard.LaboratoryEmployeesDashboard.LaboratoryInvoices.add_diagnosis', compact('invoice'));
    }
    /**
     *
     * @param mixed $request
     * @param mixed $id
     */
    function update($request, $id) {
        DB::beginTransaction();
        try {
            $invoice = Laboratory::findOrFail($id);
            $invoice->update([
                'laboratory_employee_id' => auth()->user()->id,
                'description_employee' => $request->description_employee,
                'case' => 1,
            ]);
            if ($request->hasFile('photos')) {
                foreach ($request->photos as $photo) {
                    $this->uploadImageRay($photo,'upload_image','Laboratories',$id, 'App\Models\Laboratory');
                }
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
    function view_laboratories($id) {
        $laboratorie = Laboratory::findOrFail($id);
        if ($laboratorie->laboratory_employee_id != auth()->user()->id ) {
            return redirect()->route('404');
        }
        return view('Dashboard.LaboratoryEmployeesDashboard.LaboratoryInvoices.patient_details', compact('laboratorie'));
    }
    /**
     *
     * @param mixed $id
     */
    function show($id) {
        $image = Image::findOrFail($id);
        $file = Storage::disk('upload_image')->path($image->fileName);
        return response()->download($file);
    }
}
