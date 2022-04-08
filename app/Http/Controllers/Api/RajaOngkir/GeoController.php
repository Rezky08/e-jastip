<?php

namespace App\Http\Controllers\Api\RajaOngkir;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Kavist\RajaOngkir\Resources\AbstractLocation;
use Kavist\RajaOngkir\Resources\Kota;
use Kavist\RajaOngkir\Resources\Provinsi;
use Rezky\LaravelResponseFormatter\Http\Code;
use Rezky\LaravelResponseFormatter\Http\Response;

class GeoController extends Controller
{
    protected array|AbstractLocation $result;
    /**
     * @param Request $request
     * @return Response | JsonResponse
     */
    public function provinsi(Request $request): Response | JsonResponse
    {
        /** @var Provinsi $provinsi */
        $provinsi = RajaOngkir::provinsi();
        if (!$request->hasAny(["search","id"])){
            $this->result = $provinsi->all();
        }
        $request->whenHas("search",fn($value)=> $this->result = $provinsi->search($value??"")->get());
        $request->whenHas("id",fn($value)=> $this->result = $provinsi->find($value??""));
        return new Response(Code::CODE_SUCCESS,$this->result);
    }

    /**
     * @param Request $request
     * @return Response | JsonResponse
     */
    public function kota(Request $request): Response | JsonResponse
    {
        /** @var Kota $kota */
        $kota = RajaOngkir::kota();
        $this->result = $kota;
        if (!$request->hasAny(["provinsi_id","search","id"])){
            $this->result = $this->result->all();
            return new Response(Code::CODE_SUCCESS,$this->result);
        }

        $request->whenHas("provinsi_id",fn($value)=> $this->result = $this->result->dariProvinsi($value));
        $request->whenHas("search",fn($value)=> $this->result = $this->result->search($value??""));
        if (!$request->has("id")){
            return new Response(Code::CODE_SUCCESS,$this->result->get());
        }else{
            $request->whenHas("id",fn($value)=> $this->result = $this->result->find($value??""));
            return new Response(Code::CODE_SUCCESS,$this->result);
        }
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
