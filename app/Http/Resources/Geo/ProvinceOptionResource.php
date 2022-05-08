<?php

namespace App\Http\Resources\Geo;

use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceOptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->resource->province_id,
            'text'=> $this->resource->province_name
        ];
    }
}
