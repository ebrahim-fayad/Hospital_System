<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\DoctorRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function index()
    {
        return view('Dashboard.DoctorAuth.index');
    }
    public function store(DoctorRequest $request)
    {
        if ($request->authenticate()) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::DOCTOR);
        }

        return redirect()->back()->with('error', trans('Dashboard/auth.failed'));
    }
    public function destroy(Request $request)
    {
        Auth::guard('doctor')->logout();

        $request->session()->forget('guard.doctor');

        $request->session()->regenerateToken();

        return to_route('home');
    }
}
