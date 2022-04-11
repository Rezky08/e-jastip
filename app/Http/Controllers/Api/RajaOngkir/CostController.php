<?php

namespace App\Http\Controllers\Api\RajaOngkir;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Kavist\RajaOngkir\Resources\AbstractLocation;
use Rezky\LaravelResponseFormatter\Http\Response;

class CostController extends Controller
{
    protected array|AbstractLocation|Builder|Collection $result;


    /**
     * @param Request $request
     * @return Response | JsonResponse
     */
    public function index(Request $request)
    {
        $request->mergeIfMissing(['origin' => config('setting.geo.origin')]);

        $couriers = ['jne', 'tiki', 'pos'];
        Validator::make($request->all(), [
            'code' => ['filled', Rule::in($couriers)],
            'origin' => ['required', 'filled'],
            'destination' => ['required', 'filled'],
            'weight' => ['required', 'filled'],
        ])->validate();


        if (!$request->has('code')) {
            $ongkosKirim = [];
            foreach ($couriers as $courier) {
                $ongkosKirim[] = $this->getCostData($request, $courier);
            }
            return new Response(Response::CODE_SUCCESS, $ongkosKirim);
        } else {
            return new Response(Response::CODE_SUCCESS, $this->getCostData($request, $request->code));
        }

    }

    public function getCostData(Request $request, $courier = "jne")
    {
        return RajaOngkir::ongkosKirim([
                'origin' => $request->origin,     // ID kota/kabupaten asal
                'destination' => $request->destination,      // ID kota/kabupaten tujuan
                'weight' => $request->weight ?? 1,    // berat barang dalam gram
                'courier' => $courier    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
            ])->get()[0] ?? [];
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
