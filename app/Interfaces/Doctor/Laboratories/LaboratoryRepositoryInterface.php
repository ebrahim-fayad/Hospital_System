<?php
namespace App\Interfaces\Doctor\Laboratories;
interface LaboratoryRepositoryInterface{
    public function store($request);
    public function update($request,$id);
    public function destroy($id);
}
