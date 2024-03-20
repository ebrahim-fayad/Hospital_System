<?php
namespace App\Interfaces\Admin\PatientAppointments;
interface PatientAppointmentRepositoryInterface{
    public function index();
    public function index2();
    public function approval($request,$id);
}
