<?php

namespace App\Http\Resources\Geo;

use App\Models\Geo\Province;
use App\Models\Geo\District;
use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var District $resource */
        $resource = $this->resource;
        if (!$resource->relationLoaded("city")){
            $resource->load("city");
        }

        /** @var Province $city */
        $city = $resource->city;
        $resource->unsetRelation('city');
        return array_merge(
            $resource->toArray(),
            $city->toArray()
        );
    }
}
