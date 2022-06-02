<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Rezky\LaravelResponseFormatter\Http\Code;
use Rezky\LaravelResponseFormatter\Http\Response;

trait usePagination
{
    public function withPagination(Builder $query, string|null $resource = null, $paginatorType = Response::PAGINATOR_TYPE_DEFAULT, $perPage = 10): Response|JsonResponse|LengthAwarePaginator|AnonymousResourceCollection
    {
        /** @var Request $request */
        $request = \Request();
        $request->whenHas('per_page', function ($value) use (&$perPage) {
            $perPage = $value;
        });
        if ($request->expectsJson()) {
            if ($resource) {
                return new Response(Code::CODE_SUCCESS, $resource::collection($query->paginate($perPage)->withQueryString()), "", $paginatorType);
            } else {
                return new Response(Code::CODE_SUCCESS, $query->paginate($perPage)->withQueryString(), "", $paginatorType);
            }
        } else {
            if ($resource) {
                return $resource::collection($query->paginate($perPage)->withQueryString());
            } else {
                return $query->paginate($perPage)->withQueryString();
            }
        }
    }

}
