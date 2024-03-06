<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RayEmployeeRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RayEmployeeController extends Controller
{
    public function index()
    {
        return view('Dashboard.Rays_Dashboard.Auth.index');
    }
    public function store(RayEmployeeRequest $request)
    {

        if ($request->authenticate()) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::RayEmployee);
        }

        return redirect()->back()->with('error', trans('Dashboard/auth.failed'));
    }
    public function destroy(Request $request)
    {
        Auth::guard('ray_employee')->logout();

        $request->session()->forget('guard.ray_employee');

        $request->session()->regenerateToken();

        return to_route('home');
    }

}
