<?php

namespace App\Repository\Admin\Ambulances;


use App\Interfaces\Admin\Ambulances\AmbulanceRepositoryInterface;
use App\Models\Ambulance;
use Illuminate\Support\Facades\DB;

class AmbulanceRepository implements AmbulanceRepositoryInterface
{
    public function index()
    {
        $ambulances = Ambulance::all();
        return view('Dashboard.Ambulances.index', compact('ambulances'));
    }
    public function create()
    {
        return view('Dashboard.Ambulances.create');
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            Ambulance::create([
                'car_number' => $request->car_number,
                'car_model' => $request->car_model,
                'car_year_made' => $request->car_year_made,
                'car_type' => $request->car_type,
                'driver_name' => $request->driver_name,
                'driver_license_number' => $request->driver_license_number,
                'driver_phone' => $request->driver_phone,
                'notes' => $request->notes,
                ]);
                DB::commit();
                session()->flash('add');
            return to_route('Ambulances.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $ambulance = Ambulance::findOrFail($id);
        return view('Dashboard.Ambulances.edit', compact('ambulance'));
    }
    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            if ($request->has('is_available')) {
                $status = $request->status;
            }else{
                $status = 0;
            }
            Ambulance::findOrFail($id)->update([
                'car_number' => $request->car_number,
                'car_model' => $request->car_model,
                'car_year_made' => $request->car_year_made,
                'car_type' => $request->car_type,
                'is_available'=>$status,
                'driver_name' => $request->driver_name,
                'driver_license_number' => $request->driver_license_number,
                'driver_phone' => $request->driver_phone,
                'notes' => $request->notes,
            ]);
            DB::commit();
            session()->flash('edit');
            return to_route('Ambulances.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        Ambulance::destroy($id);
        session()->flash('delete');
        return to_route('Ambulances.index');
    }
}
