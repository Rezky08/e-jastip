<?php

namespace App\Http\Controllers\Api\RajaOngkir;

use App\Http\Controllers\Controller;
use App\Http\Resources\Geo\DistrictResource;
use App\Models\Geo\City;
use App\Models\Geo\District;
use App\Traits\usePagination;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
    use usePagination;

    protected array|AbstractLocation|Builder|Collection $result;

    /**
     * @param Request $request
     * @return Response | JsonResponse
     */
    public function provinsi(Request $request): Response|JsonResponse
    {
        /** @var Provinsi $provinsi */
        $provinsi = RajaOngkir::provinsi();
        if (!$request->hasAny(["search", "id"])) {
            $this->result = $provinsi->all();
        }
        $request->whenHas("search", fn($value) => $this->result = $provinsi->search($value ?? "")->get());
        $request->whenHas("id", fn($value) => $this->result = $provinsi->find($value ?? ""));
        return new Response(Code::CODE_SUCCESS, $this->result);
    }

    /**
     * @param Request $request
     * @return Response | JsonResponse
     */
    public function kota(Request $request): Response|JsonResponse
    {
        /** @var Kota $kota */
        $kota = RajaOngkir::kota();
        $this->result = $kota;
        if (!$request->hasAny(["province_id", "search", "id"])) {
            $this->result = $this->result->all();
            return new Response(Code::CODE_SUCCESS, $this->result);
        }

        $request->whenHas("province_id", fn($value) => $this->result = $this->result->dariProvinsi($value));
        $request->whenHas("search", fn($value) => $this->result = $this->result->search($value ?? ""));
        if (!$request->has("id")) {
            return new Response(Code::CODE_SUCCESS, $this->result->get());
        } else {
            $request->whenHas("id", fn($value) => $this->result = $this->result->find($value ?? ""));
            return new Response(Code::CODE_SUCCESS, $this->result);
        }
    }

    /**
     * @param Request $request
     * @return Response | JsonResponse
     */
    public function kecamatan(Request $request): Response|JsonResponse
    {
        /** @var Builder $kecamatan */
        $kecamatan = District::query();
        $this->result = $kecamatan;

        if (!$request->hasAny(["city_id", "search", "id"])) {
            return $this->withPagination($this->result,DistrictResource::class);
        }

        $request->whenHas("city_id", fn($value) => $this->result = $this->result->where('city_id', $value));
        $request->whenHas("search", fn($value) => $this->result = $this->result->where('district_name', 'ilike', "%" . ($value ?? "") . "%"));
        if (!$request->has("id")) {
            return $this->withPagination($this->result,DistrictResource::class);
        } else {
            $result = null;
            $request->whenHas("id", function ($value) use (&$result) {
                $result = $this->result->find($value ?? "");
            });
            return new Response(Code::CODE_SUCCESS, DistrictResource::make($result));
        }
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
