<?php

namespace App\Repository\Admin\Doctors;


use App\Interfaces\Admin\Doctors\DoctorRepositoryInterface;
use App\Models\Appointment;
use App\Models\AppointmentTranslation;
use App\Models\Doctor;
use App\Models\Image;
use App\Models\Section;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DoctorRepository implements DoctorRepositoryInterface
{
    use UploadTrait;
    public function index()
    {
        $doctors = Doctor::latest()->get();
        return view('Dashboard.Doctors.index', compact('doctors'));
    }
    public function create()
    {
        $sections = Section::all();
        $appointments = Appointment::all();
        return view('Dashboard.Doctors.add', compact('sections', 'appointments'));
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $doctor = Doctor::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'section_id' => $request->section_id,
                'phone' => $request->phone,
                'price' => $request->price,
            ]);
            $appointments =  $request->appointments;

            $doctor->doctorAppointments()->attach($appointments);
            $this->uploadImage($request, 'upload_image', 'photo', 'Doctors', $doctor->id, 'App\Models\Doctor');

            DB::commit();
            session()->flash('add');
            return redirect()->route('Doctors.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($request, $id)
    {
        if ($request->page_id == 1) {
            $doctor = Doctor::findOrFail($id);
            if ($request->fileName) {
                $images = Image::where('imageable_id', $doctor->id)->get();
                // foreach ($images as $image) {
                    $this->deleteImage('upload_image', $doctor->id);
                // }
            }

            $doctor->delete();
            session()->flash('delete');

            return redirect()->back();
        } // end ($request->page_id == 1)
        else {
            $doctors_ids = explode(",", $request->delete_select_id);
            foreach ($doctors_ids as $doctor_id) {
                $doctor = Doctor::findOrFail($doctor_id);
                if ($doctor->image) {
                    // $images = Image::where('imageable_id', $doctor->id)->get();
                    // foreach ($images as $image) {
                        $this->deleteImage('upload_image', $doctor->id);
                        // }
                } //end of doctor image
                $doctor->delete();
            }//end foreach
            session()->flash('delete');

            return to_route('Doctors.index');
        }//end else
    }//end destroy
    public function edit($id)
    {
        $sections = Section::all();
        $appointments = Appointment::all();
        $doctor = Doctor::findOrFail($id);
        return view('Dashboard.Doctors.edit', compact('sections', 'appointments', 'doctor'));
    }
    public function update($request, $id)
    {

        DB::beginTransaction();
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $doctor->password,
                'section_id' => $request->section_id,
                'phone' => $request->phone,
                'price' => $request->price,
                ]);
            $doctor->doctorAppointments()->sync($request->appointments);
            if ($request->photo) {
                $this->deleteImage('upload_image', $doctor->id);
                    $this->uploadImage($request, 'upload_image', 'photo', 'Doctors', $doctor->id, 'App\Models\Doctor');
            }

            DB::commit();
            session()->flash('add');
            return to_route('Doctors.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update_password($request, $id)
    {
        DB::beginTransaction();
        try {
            Doctor::findOrFail($id)->update([
                'password'=>Hash::make( $request->password),
            ]);
            DB::commit();
            session()->flash('edit');
            return to_route('Doctors.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update_status($request, $id)
    {
         try {
            $doctor = Doctor::findOrFail($id);
            $doctor->update([
                'status' => $request->status
            ]);

            session()->flash('edit');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
