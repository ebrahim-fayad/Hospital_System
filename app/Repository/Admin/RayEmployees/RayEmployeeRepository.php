<?php
namespace App\Repository\Admin\RayEmployees;
use App\Interfaces\Admin\RayEmployees\RayEmployeeRepositoryInterface;
use App\Models\RayEmployee;
use App\Traits\UploadTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RayEmployeeRepository  implements RayEmployeeRepositoryInterface
{
    use UploadTrait;

    /**
     */
    function index() {
        $ray_employees = RayEmployee::all();
        return view('Dashboard.RayEmployees.index', get_defined_vars());
    }
    /**
     *
     * @param mixed $request
     */
    function store($request) {
        DB::beginTransaction();
        try {
            $rayEmployee = RayEmployee::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);
            $this->uploadImage($request, 'upload_image','photo','RayEmployees',$rayEmployee->id, 'App\Models\RayEmployee');
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
     * @param mixed $request
     * @param mixed $id
     */
    function update($request, $id) {
        DB::beginTransaction();
        try {
            $rayEmployee = RayEmployee::findOrFail($id);
            $input = $request->all();
            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = Arr::except($input, ['password']);
            }
            $rayEmployee->update($input);
            if ($request->photo) {
                $this->deleteImage('upload_image', $rayEmployee->id);
                $this->uploadImage($request, 'upload_image', 'photo', 'RayEmployees', $rayEmployee->id, 'App\Models\RayEmployee');
            }
            DB::commit();
            session()->flash('edit');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**
     *
     * @param mixed $id
     */
    function destroy($id) {
        $this->deleteImage('upload_image', $id);
        RayEmployee::destroy($id);
        session()->flash('delete');
        return redirect()->back();
    }

}


