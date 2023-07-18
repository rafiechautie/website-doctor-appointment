<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use App\Models\MasterData\TypeUser;
use Illuminate\Http\Request;

class TypeUserController extends Controller
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
        abort_if(Gate::denies('type_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        /**
         * untuk mengambil data pertama bisa pakek limit atau first
         * contoh:
         * 1. $type_user = TypeUser::where('id', 1)->first()->contoh ambil data pertama menggunakan first()
         * 2. $type_user = TypeUser::where('id', 1)->limit(1)->get() -> contoh ambil data pertama menggunakan limit()
         * 
         * bedanya apa?
         * misal di model TypeUser ada 5 data yang idnya sama sama punya value 1
         * 
         * jika menggunakan first() maka data yang diambil hanya satu data saja tapi yang unique
         * jika menggunakan limit() maka data yang diambil hanya satu data saja di urutan pertama
         * 
         * perbedaan lainya 
         * limit digunakan untuk mengendalikan jumlah catatan yang dikembalikan dalam set hasil. 
         * first digunakan untuk mengambil catatan pertama dari set hasil.
         * 
         * 
         * pengambilan data ada 3 jenis dalam pengambilan data di laravel
         * 1. all retrieves all records from a table and returns a collection. 
         * 2. get retrieves records based on specified conditions and returns a collection.
         * 3. pluck retrieves a single column's value from the first result and returns a single value or an array.
         * 
         */

        //ambil seluruh data di dalam model TypeUser
        $type_user = TypeUser::all();

        return view('pages.backsite.management-access.type-user.index', compact('type_user'));
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
