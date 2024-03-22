<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Admin\PatientAppointments\PatientAppointmentRepositoryInterface;
use Illuminate\Http\Request;

class AppointmentsPatient extends Controller
{
    private $PatientAppointments;
    public function __construct(PatientAppointmentRepositoryInterface $PatientAppointments)
    {
        $this->PatientAppointments = $PatientAppointments;
    }
    public function index()
    {
        return $this->PatientAppointments->index();
    }
    public function index2()
    {
        return $this->PatientAppointments->index2();
    }
    public function approval(Request $request,$id)
    {
        return $this->PatientAppointments->approval($request, $id);
    }
    public function destroy($id)
    {
        return $this->PatientAppointments->destroy( $id);
    }
}
