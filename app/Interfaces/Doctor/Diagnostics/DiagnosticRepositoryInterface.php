<?php
namespace App\Interfaces\Doctor\Diagnostics;
interface DiagnosticRepositoryInterface {
    public function store($request);
    public function show($id);
}
