<?php

namespace App\Livewire\Website\Appointments;

use App\Events\PatientAppointmentCreate;
use App\Models\Doctor;
use App\Models\PatientAppointment;
use App\Models\Section;
use Livewire\Component;

class Create extends Component
{
    public $section_id, $doctor,$doctors,$name,$email,$phone,$notes,$message=false;
    public function mount()
    {
        $this->doctors=[];
    }
    public function getDoctors()
    {
        $this->doctors=Doctor::where('section_id',$this->section_id)->get();
        $this->doctor=$this->doctors->first()->id;
    }
    public function store()
    {
        PatientAppointment::create([
            'doctor_id'=>$this->doctor,
            'section_id'=>$this->section_id,
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'notes'=>$this->notes,
        ]);
        $data = [
            'name' => $this->name,
            'doctor' => $this->doctor,
            'section' => $this->section_id,
        ];
        event(new PatientAppointmentCreate($data));
        $this->message=true;
        $this->reset('section_id','doctor','name','email','phone','notes');
        $this->doctors=[];
        // return to_route('home');
    }


    public function render()
    {
        return view('website.appointments.create',[
            'sections'=>Section::all(),
        ]);
    }
}
