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

        //store to database satu satu
        //contoh
        //$specialist = new Specialist
        //$specialist->request->name;
        //$specialist->request->description;
        //$specialist->save();

        return redirect()->route('specialist.index');

        alert()->success('Success Message', 'Successfully added new specialist');

        alert()->success('Success Message', 'Successfully added new specialist');
        return redirect()->route('backsite.specialist.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return view('pages.backsite.master-data.specialist.show', compact('specialist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return view('pages.backsite.master-data.specialist.edit', compact('specialist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  Specialist $specialist)
    {
        //

        // get all request from frontsite
        $data = $request->all();


        $data['price'] = str_replace(',', '', $data['price']);
        $data['price'] = str_replace('IDR ', '', $data['price']);

        // update to database
        $specialist->update($data);

        /**
         * cara update spesifik field
         * 
         * $flight = Flight::find(1);
         * $flight->name = 'Paris to London';
         * $flight->save();
         */

        alert()->success('Success Message', 'Successfully updated specialist');
        return redirect()->route('backsite.specialist.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialist $specialist)
    {
        //
        $specialist->forceDelete();

        alert()->success('Success Message', 'Successfully deleted specialist');
        return back();
    }
}
