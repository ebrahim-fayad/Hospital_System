<?php
namespace App\Interfaces\Doctor\Rays;
interface RayRepositoryInterface {
    public function store($request);
    public function update($request,$id);
    public function destroy($id);
}
