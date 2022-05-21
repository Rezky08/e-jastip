<?php

namespace App\Http\Controllers\Api\RajaOngkir;

use App\Http\Controllers\Controller;
use App\Http\Resources\Geo\CityOptionResource;
use App\Http\Resources\Geo\DistrictResource;
use App\Http\Resources\Geo\DistrictOptionResource;
use App\Http\Resources\Geo\ProvinceOptionResource;
use App\Http\Resources\Master\StudyProgramOptionResource;
use App\Models\Geo\City;
use App\Models\Geo\Province;
use App\Models\Geo\District;
use App\Models\Master\Faculty;
use App\Traits\OptionResourceable;
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
    use usePagination, OptionResourceable;

    public function province(Request $request): \Rezky\LaravelResponseFormatter\Http\Response|\Illuminate\Http\JsonResponse
    {
        return $this->search($request, Province::class, ['province_name' => 'search'], ['province_id' => 'id'], ProvinceOptionResource::class);
    }

    public function city(Request $request): \Rezky\LaravelResponseFormatter\Http\Response|\Illuminate\Http\JsonResponse
    {
        return $this->search($request, City::class, ['city_name' => 'search'], ['city_id' => 'id', 'province_id' => 'chainValue'], CityOptionResource::class);
    }

    public function district(Request $request): \Rezky\LaravelResponseFormatter\Http\Response|\Illuminate\Http\JsonResponse
    {
        return $this->search($request, District::class, ['district_name' => 'search'], ['district_id' => 'id', 'city_id' => 'chainValue'], DistrictOptionResource::class);
    }

}
