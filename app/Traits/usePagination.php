<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Rezky\LaravelResponseFormatter\Http\Code;
use Rezky\LaravelResponseFormatter\Http\Response;

trait usePagination
{
    public function withPagination(Builder $query, string|null $resource = null, $paginatorType = Response::PAGINATOR_TYPE_DEFAULT): Response|JsonResponse
    {
        $perPage = 10;
        \Request::whenHas('per_page', function ($value) use (&$perPage) {
            $perPage = $value;
        });
        if ($resource) {
            return new Response(Code::CODE_SUCCESS, $resource::collection($query->paginate($perPage)->withQueryString()), "", $paginatorType);
        } else {
            return new Response(Code::CODE_SUCCESS, $query->paginate($perPage)->withQueryString(), "", $paginatorType);
        }
    }

}
