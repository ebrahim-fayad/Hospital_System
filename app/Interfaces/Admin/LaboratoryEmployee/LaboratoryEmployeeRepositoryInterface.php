<?php
namespace App\Interfaces\Admin\LaboratoryEmployee;

interface LaboratoryEmployeeRepositoryInterface{
    public function index();
    public function store($request);
    public function update($request,$id);
    public function destroy($id);
}
