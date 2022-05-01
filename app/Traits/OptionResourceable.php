<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Rezky\LaravelResponseFormatter\Http\Code;
use Rezky\LaravelResponseFormatter\Http\Response;

trait OptionResourceable
{
    public Builder|null $query = null;
    public Collection|null $result = null;


    function makeSearchQuery($modelClass = null)
    {
        $this->query = $modelClass::query();
    }

    function addQueryFindField(Request $request, $requestFieldName, $dbFieldName = null)
    {
        $dbFieldName = $dbFieldName ?? $requestFieldName;
        $request->whenHas($requestFieldName, fn($value) => $this->query = $this->query->where($dbFieldName, $value));
    }

    function addQuerySearchField(Request $request, $requestFieldName, $dbFieldName = null)
    {
        $dbFieldName = $dbFieldName ?? $requestFieldName;
        if (!is_array($dbFieldName)) {
            $request->whenHas($requestFieldName, fn($value) => $this->query = $this->query->where($dbFieldName, 'ilike', "%" . $value . "%"));
        } else {
            // combine db field
            $request->whenHas($requestFieldName, fn($value) => $this->query = $this->query->where(function ($query) use ($dbFieldName,$value) {
                foreach ($dbFieldName as $field){
                    $query->orWhere($field,'ilike', "%" . $value . "%");
                }
            }));
        }
    }

    function search(Request $request, $modelClass = null, $searchFields = [], $findFields = [], $resourceClass = null)
    {
        $this->makeSearchQuery($modelClass);

        $fieldParams = array_merge(array_values($searchFields), array_values($findFields));
        if (!$request->hasAny($fieldParams)) {
            return $this->withPagination($this->query, $resourceClass);
        }

        foreach ($searchFields as $dbFieldName => $requestFieldName) {
            if (!is_int($dbFieldName)) {
                $fields = explode(",", $dbFieldName);
                $this->addQuerySearchField($request, $requestFieldName, count($fields) > 1 ? $fields : $dbFieldName);
            } else {
                $this->addQuerySearchField($request, $requestFieldName);
            }
        }

        foreach ($findFields as $dbFieldName => $requestFieldName) {
            if (!is_int($dbFieldName)) {
                $this->addQueryFindField($request, $requestFieldName, $dbFieldName);
            } else {
                $this->addQueryFindField($request, $requestFieldName);
            }
        }

        if (!$request->has("id")) {
            return $this->withPagination($this->query, $resourceClass);
        } else {
            $result = null;
            $request->whenHas("id", function ($value) use (&$result) {
                $result = $this->query->find($value ?? "");
            });
            $resourceData = $resourceClass ? $resourceClass::make($result) : $result;
            return new Response(Code::CODE_SUCCESS, $resourceData);
        }
    }
}
