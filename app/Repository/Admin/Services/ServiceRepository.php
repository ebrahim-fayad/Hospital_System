<?php

namespace App\Repository\Admin\Services;

use App\Interfaces\Admin\Services\ServiceRepositoryInterface;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function index()
    {
        $services = Service::all();
        return view('Dashboard.Services.Single-Service.index', compact('services'));
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            Service::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
            ]);
            DB::commit();
            session()->flash('add');
            return to_route('Services.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            Service::findOrFail($id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'status' => $request->status,
            ]);
            DB::commit();
            session()->flash('edit');
            return to_route('Services.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Service::findOrFail($id)->delete();
            DB::commit();
            session()->flash('delete');
            return to_route('Services.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
