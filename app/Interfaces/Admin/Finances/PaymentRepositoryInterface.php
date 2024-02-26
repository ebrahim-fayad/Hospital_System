<?php


namespace App\Interfaces\Admin\Finances;


interface PaymentRepositoryInterface
{
    // get All Receipt
    public function index();

    // show form add
    public function create();

    // store Receipt
    public function store($request);

    // // edit Receipt
    public function show($id);
    public function edit($id);

    // Update Receipt
    public function update($request,$id);

    // destroy Receipt
    public function destroy($id);
}
