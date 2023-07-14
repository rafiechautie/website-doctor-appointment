<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use App\Http\Requests\Specialist\StoreSpecialistRequest;
use App\Models\MasterData\Specialist;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //mengambil seluruh data bedasarkan created at dan ditampilkannya descending
        $specialist = Specialist::orderBy('created_at', 'desc')->get();

        return view('pages.backsite.master-data.specialist.index', compact('specialist'));
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
    public function store(StoreSpecialistRequest $request)
    {
        //
        // get all request from frontsite
        $data = $request->all();

        //kalau mau ambil request decara spesifik dari frontsite
        //contoh jika yang diambil hanya pricenya saja
        // $data = $request->price()
        //atau
        //$data = $request['price']

        // re format before push to table
        $data['price'] = str_replace(',', '', $data['price']);
        $data['price'] = str_replace('IDR ', '', $data['price']);

        // store to database
        $specialist = Specialist::create($data);

        alert()->success('Success Message', 'Successfully added new specialist');
        return redirect()->route('backsite.specialist.index');
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
