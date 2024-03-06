<?php
namespace App\Repository\Rays;
use App\Interfaces\Rays\RayInvoicesRepositoryInterface;
use App\Models\Ray;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\DB;

class RayInvoicesRepository implements RayInvoicesRepositoryInterface{

    use UploadTrait;
    /**
     */
    function index() {
        $invoices = Ray::where('case',0)->get();
        return view('Dashboard.Rays_Dashboard.invoices.index', get_defined_vars());
    }
    /**
     */
    function completedRayInvoices()
    {
         $invoices = Ray::where('case',1)->get();
        return view('Dashboard.Rays_Dashboard.invoices.index', get_defined_vars());
    }
    /**
     *
     * @param mixed $id
     */
    function edit($id) {
        $invoice = Ray::findOrFail($id);
        return view('Dashboard.Rays_Dashboard.invoices.add_diagnosis',compact('invoice'));
    }

    /**
     *
     * @param mixed $request
     * @param mixed $id
     */
    function update($request, $id) {
        DB::beginTransaction();
        try {
            $Ray = Ray::findOrFail($id);
            $Ray->update([
                'employee_id'=>auth()->user()->id,
                'description_employee' => $request->description_employee,
                'case' => 1,
            ]);
             if( $request->hasFile( 'photos' ) ) {
                foreach ($request->photos as $photo) {
                    $this->uploadImageRay($photo,'upload_image','Rays',$Ray->id, 'App\Models\Ray');
                    // $name = $photo->getClientOriginalName();
                    // dd($name);
                }
            }
            DB::commit();
            session()->flash('add');
            return to_route('Rays_Invoices.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
