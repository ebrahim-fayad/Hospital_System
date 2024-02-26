<?php

namespace App\Interfaces\Admin\Doctors;



interface DoctorRepositoryInterface
{
    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request,$id);
    public function destroy($request , $id);
    public function update_password($request , $id);
    public function update_status($request , $id);
}
