<?php
namespace App\Repository\Doctor\Rays;
use App\Interfaces\Doctor\Rays\RayRepositoryInterface;
use App\Models\Ray;

class RayRepository implements RayRepositoryInterface{

    /**
     *
     * @param mixed $request
     */
    function store($request) {
        $request->validate([
            'description' => 'required',
        ],[
            'description.required'=>"can not be null"
        ]);
        Ray::create($request->all());
        session()->flash('add');
        return redirect()->back();
    }
    /**
     *
     * @param mixed $request
     * @param mixed $id
     */
    function update($request, $id) {
        $request->validate([
            'description' => 'required',
        ], [
            'description.required' => "can not be null"
        ]);
        Ray::findOrFail($id)->update($request->all());
        session()->flash('edit');
        return redirect()->back();
    }
    /**
     *
     * @param mixed $id
     */
    function destroy($id) {
        Ray::destroy($id);
        session()->flash('delete');
        return redirect()->back();
    }
}
