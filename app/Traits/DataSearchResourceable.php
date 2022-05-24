<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Rezky\LaravelResponseFormatter\Http\Code;
use Rezky\LaravelResponseFormatter\Http\Response;

trait DataSearchResourceable
{
    public Builder|null $query = null;
    public Collection|Model|null $result = null;
    protected bool $searchReturnResponse = true;
    protected int $paginatorType = Response::PAGINATOR_TYPE_DEFAULT;
    protected array $orderBy = [];
    protected Request $request;


    function makeSearchQuery($modelClass = null)
    {
        if ($modelClass instanceof Builder) {
            $this->query = $modelClass;
        } else {

            $this->query = $modelClass::query();
        }
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
            $request->whenHas($requestFieldName, function ($value) use ($dbFieldName) {
                if (Str::contains($dbFieldName, '.')) {
                    $fields = explode('.', $dbFieldName);
                    $field = array_pop($fields);
                    $relations = implode('.', $fields);
                    $this->query = $this->query->whereHas($relations, function ($query) use ($field, $value) {
                        $query->where($field, 'ilike', "%" . $value . "%");
                    });
                } else {
                    $this->query = $this->query->where($dbFieldName, 'ilike', "%" . $value . "%");
                }

            });
        } else {
            // combine db field
            $request->whenHas($requestFieldName, function ($value) use ($dbFieldName) {
                $this->query = $this->query->where(function ($query) use ($dbFieldName, $value) {
                    foreach ($dbFieldName as $field) {
                        if (Str::contains($field, '.')) {
                            $fields = explode('.', $field);
                            $field = array_pop($fields);
                            $relations = implode('.', $fields);
                            $query->orWhereHas($relations, function ($query) use ($field, $value) {
                                $query->where($field, 'ilike', "%" . $value . "%");
                            });
                        } else {
                            $query->orWhere($field, 'ilike', "%" . $value . "%");
                        }
                    }
                });
            });
        }
    }

    function searchResult($resourceClass, $isSingle = false)
    {
        if (!empty($this->orderBy)) {
            $this->query->orderBy($this->orderBy['column'], $this->orderBy['dir']);
        }
        if ($this->searchReturnResponse) {
            if ($isSingle) {
                $resourceData = $resourceClass ? $resourceClass::make($this->result) : $this->result;
                return new Response(Code::CODE_SUCCESS, $resourceData);
            }

            return $this->withPagination($this->query, $resourceClass, $this->paginatorType);
        } else {
            return $this->result ?? $this->query;
        }
    }

    function setOrderResult($column = null, $sortDirection = null)
    {
        if ($this->paginatorType === Response::PAGINATOR_TYPE_DATA_TABLE) {
            $orderBys = $this->request->get('order');
            $orderBy = array_shift($orderBys);
            $columns = $this->request->get('columns');

            $column = $columns[$orderBy['column']];
            if ((bool)$column['orderable']) {
                $this->orderBy = [
                    'column' => $column['name'] ?? $column['data'],
                    'dir' => $orderBy['dir']
                ];
            }

        }
    }

    function search(Request $request, $modelClass = null, $searchFields = [], $findFields = [], $resourceClass = null, $paginatorType = Response::PAGINATOR_TYPE_DEFAULT)
    {
        $this->request = $request;
        $this->paginatorType = $paginatorType;
        $this->makeSearchQuery($modelClass);
        $this->setOrderResult();

        $fieldParams = array_merge(array_values($searchFields), array_values($findFields));
        if (!$request->hasAny($fieldParams)) {
            return $this->searchResult($resourceClass);
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
            return $this->searchResult($resourceClass);
        } else {

            $request->whenHas("id", function ($value) {
                $this->result = $this->query->find($value ?? "");
            });
            return $this->searchResult($resourceClass, true);
        }
    }
}
