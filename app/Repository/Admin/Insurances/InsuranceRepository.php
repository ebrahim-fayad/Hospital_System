<?php

namespace App\Repository\Admin\Insurances;

use App\Interfaces\Admin\Insurances\InsuranceRepositoryInterface;
use Illuminate\Support\Str;
use App\Models\Insurance;
use Illuminate\Support\Facades\DB;

class InsuranceRepository implements InsuranceRepositoryInterface
{

    public function index()
    {
        $insurances = Insurance::all();
        return view('Dashboard.Insurances.index', compact('insurances'));
    }
    public function create()
    {
        return view('Dashboard.Insurances.create');
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            // توليد الرمز تلقائيًا بالتنسيق مطلوب
            $insuranceCode = strtoupper(Str::random(1)) . rand(10, 99) . '-' . rand(10, 99) . '-' . strtolower(Str::random(1));

            // التحقق مما إذا كان الرمز موجودًا مسبقًا في الجدول
            while (Insurance::where('insurance_code', $insuranceCode)->exists()) {
                // إذا كان الرمز موجودًا بالفعل، قم بإنشاء رمز جديد
                $insuranceCode = strtoupper(Str::random(1)) . rand(10, 99) . '-' . rand(10, 99) . '-' . strtolower(Str::random(1));
            }

            // إنشاء التأمين مع الرمز الجديد
            $insurance = Insurance::create([
                'name' => $request->name,
                'insurance_code' => $insuranceCode,
                'discount_percentage' => $request->discount_percentage,
                'Company_rate' => $request->Company_rate,
                'notes' => $request->notes,
            ]);

            DB::commit();

            session()->flash('add');
            return redirect()->route('Insurances.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $insurance = Insurance::findOrFail($id);
        return view('Dashboard.Insurances.edit', compact('insurance'));
    }

    public function update($request, $id)
    {
        if ($request->status) {
            $status = 1;
        } else {
            $status = 0;
        }

        Insurance::findOrFail($id)->update([
            'name' => $request->name,
            'status' => $status,
            'discount_percentage' => $request->discount_percentage,
            'Company_rate' => $request->Company_rate,
            'notes' => $request->notes,
        ]);
        session()->flash('edit');
        return to_route('Insurances.index');
    }
    public function destroy($id)
    {
        Insurance::findOrFail($id)->delete();
        session()->flash('delete');
        return to_route('Insurances.index');
    }
}
