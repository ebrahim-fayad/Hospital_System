<?php
namespace App\Repository\Admin\PatientAppointments;

use App\Interfaces\Admin\PatientAppointments\PatientAppointmentRepositoryInterface;
use App\Models\PatientAppointment;

class PatientAppointmentRepository  implements PatientAppointmentRepositoryInterface
{

    /**
     */
    function index() {
        $appointments = PatientAppointment::where('type', 'غير مؤكد')->get();
        return view('Dashboard.PatientAppointments.index', compact('appointments'));
    }
    /**
     */
    function index2() {
        $appointments = PatientAppointment::where('type', 'مؤكد')->get();
        return view('Dashboard.PatientAppointments.index2', compact('appointments'));
    }
    /**
     */
    function approval($request, $id) {
        PatientAppointment::findOrFail($id)->update([
         'type'=>'مؤكد',
            'appointment'=>$request->appointment
        ]);
        session()->flash('add');
        return back();
    }
    
}

