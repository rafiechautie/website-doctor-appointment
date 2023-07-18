<?php

namespace App\Http\Controllers\Frontsite;

//use library here
use App\Http\Controllers\Controller;
use App\Models\MasterData\Specialist;
use App\Models\Operational\Doctor;
use Illuminate\Http\Request;


//user everything here

//use model here

//Use thirdparty in here

class LandingController extends Controller
{

    // public function __construct()
    // {
    //     //menandai bahwa landing page boleh digunakan secara full ketika user sudah login
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $specialist = Specialist::inRandomOrder()->limit(5)->get();
        $doctor = Doctor::orderBy('created_at', 'desc')->limit(4)->get();

        return view('pages.frontsite.landing-page.index', compact('doctor', 'specialist'));
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
        return abort(404);
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
}
