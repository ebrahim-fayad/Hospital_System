<?php
namespace App\Interfaces\Rays;
interface RayInvoicesRepositoryInterface{
    public function index();
    public function edit($id);
    public function update($request,$id);
}
