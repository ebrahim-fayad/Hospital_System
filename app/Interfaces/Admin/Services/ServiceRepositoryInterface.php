<?php

namespace App\Interfaces\Admin\Services;



interface ServiceRepositoryInterface
{
    public function index();
    public function store($request);
    public function update($request,$id);
    public function destroy($id);
}
