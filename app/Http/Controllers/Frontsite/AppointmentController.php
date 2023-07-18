<?php

namespace App\Http\Controllers\Frontsite;

use App\Http\Controllers\Controller;
use App\Models\MasterData\Consultation;
use Illuminate\Http\Request;

// use everything here
// use Gate;
use Auth;


use App\Models\Operational\Appointment;
use App\Models\Operational\Doctor;

class AppointmentController extends Controller
{
    public function __construct()
    {
        //menandai bahwa landing page boleh digunakan secara full ketika user sudah login
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('pages.frontsite.appointment.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        $appointment = new Appointment();
        $appointment->doctor_id = $data['doctor_id'];
        $appointment->user_id = Auth::user()->id;
        $appointment->consultation_id = $data['consultation_id'];
        $appointment->level = $data['level_id'];
        $appointment->date = $data['date'];
        $appointment->time = $data['time'];
        $appointment->status = 2; // set to waiting payment
        $appointment->save();

        return redirect()->route('payment.appointment', $appointment->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        return abort(404);
    }

    // custom

    public function appointment($id)
    {
        $doctor = Doctor::where('id', $id)->first();
        $consultation = Consultation::orderBy('name', 'asc')->get();

        return view('pages.frontsite.appointment.index', compact('doctor', 'consultation'));
    }
}
