<?php

namespace App\Http\Controllers\PengajuanLegalisir;

use App\Http\Controllers\Controller;
use App\Jobs\Temporary\Transaction\CreateTransaction;
use App\Jobs\Transaction\Invoice\CreateInvoice;
use App\Models\Temporary\Transaction;
use App\Models\Transaction\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Jalameta\Attachments\Concerns\AttachmentCreator;

class IjazahController extends Controller
{
    use AttachmentCreator;
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.pengajuan-legalisir.ijazah.index");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'province_id'=>$request->provinsi,
            'city_id'=>$request->kota,
            'district_id'=>$request->kecamatan,
            'zip_code'=>$request->kode_pos,
            'address'=>$request->alamat,
            'partner_shipment_code' => $request->get('cost-selector_code'),
            'partner_shipment_service' => $request->get('cost-selector_service'),
            'partner_shipment_price' => $request->get('cost-selector_price'),
            'partner_shipment_etd' => $request->get('cost-selector_etd'),
        ];
        $job = new CreateTransaction($data);
        $this->dispatch($job);

//        if ($job->order->exists){
//            return redirect()->to("/invoice/1");
//        }
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
