<?php
namespace App\Interfaces\Rays;
interface RayInvoicesRepositoryInterface{
    public function index();
    public function completedRayInvoices();
    public function edit($id);
    public function show($id);
    public function update($request,$id);
}
