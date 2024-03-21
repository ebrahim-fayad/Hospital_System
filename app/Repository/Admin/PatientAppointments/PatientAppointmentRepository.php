<?php
namespace App\Repository\Admin\PatientAppointments;

use App\Interfaces\Admin\PatientAppointments\PatientAppointmentRepositoryInterface;
use App\Mail\AppointmentPatientConfirmation;
use App\Models\PatientAppointment;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

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
        $PatientAppointment= PatientAppointment::findOrFail($id);
         $PatientAppointment->update([
         'type'=>'مؤكد',
            'appointment'=>$request->appointment
        ]);
        Mail::to($PatientAppointment->email)->send( new AppointmentPatientConfirmation($PatientAppointment));
        $recipients = $PatientAppointment->phone;
        $message = "عزيزي المريض" . " " . $PatientAppointment->name . " " . "تم حجز موعدك بتاريخ " . $PatientAppointment->appointment;
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            $recipients,
            ['from' => $twilio_number, 'body' => $message]
        );
        session()->flash('add');
        return back();
    }

}

