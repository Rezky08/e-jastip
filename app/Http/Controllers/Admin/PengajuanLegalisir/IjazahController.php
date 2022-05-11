<?php

namespace App\Http\Controllers\Admin\PengajuanLegalisir;

use App\Http\Controllers\Controller;
use App\Models\Transaction\Transaction;
use App\Traits\usePagination;
use Illuminate\Http\Request;

class IjazahController extends Controller
{
    use usePagination;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Rezky\LaravelResponseFormatter\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()){
            $query = Transaction::query();
            return $this->withPagination($query);
        }
        return view("pages.admin.pengajuan-legalisir.ijazah.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
