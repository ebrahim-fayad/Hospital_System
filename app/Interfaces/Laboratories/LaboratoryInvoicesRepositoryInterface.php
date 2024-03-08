<?php
namespace App\Interfaces\Laboratories;
interface LaboratoryInvoicesRepositoryInterface{
    public function index();
    public function completedRayInvoices();
    public function view_laboratories($id);
    public function show($id);
    public function edit($id);
    public function update($request,$id);
}
