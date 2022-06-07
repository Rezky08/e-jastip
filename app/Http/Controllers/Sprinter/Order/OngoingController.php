<?php

namespace App\Http\Controllers\Sprinter\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Transaction\TransactionDetailResource;
use App\Http\Resources\Admin\Transaction\TransactionResource;
use App\Models\Transaction\Order;
use App\Models\Transaction\Transaction;
use App\Supports\FormSupport;
use App\Supports\Repositories\AuthRepository;
use App\Supports\Repositories\SprinterRepository\Query;
use App\Supports\Repositories\TransactionRepository;
use App\Traits\usePagination;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Rezky\LaravelResponseFormatter\Http\Response;

class OngoingController extends Controller
{
    use usePagination;

    public TransactionRepository $transactionRepository;
    public AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository, TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->authRepository = $authRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response | JsonResponse
     */
    public function index(Request $request)
    {
        /** @var Query|Builder $query */
        $query = $this->transactionRepository->queries();
        $query = $query->getOngoingTransaction();

        /** @var LengthAwarePaginator $transactions */
        $transactions = $this->withPagination($query, TransactionResource::class, Response::PAGINATOR_TYPE_DEFAULT, 5);
        if ($request->expectsJson()) {
            /** @var JsonResponse $transactions */

            return $transactions;
        }
        $data = [
            'data' => $transactions
        ];


        return view('pages.sprinter.order.ongoing.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|JsonResponse|LengthAwarePaginator|Response
     */
    public function show(Request $request, Order $order)
    {
        $transaction = $order->transaction;
        $form = TransactionDetailResource::make($transaction)->toArray($request);
        if ($request->expectsJson()) {
            $query = $transaction->documents()->getQuery();
            return $this->withPagination($query,null, Response::PAGINATOR_TYPE_DATA_TABLE);
        }
        FormSupport::storeFormData($form);
        switch ($order->status){
            case Order::ORDER_STATUS_TAKEN :
                return view('pages.sprinter.order.ongoing.detail.index');
            case Order::ORDER_STATUS_PRINT :
                return view('pages.sprinter.order.ongoing.detail.print');
            case Order::ORDER_STATUS_TO_UNIVERSITY :
                return view('pages.sprinter.order.ongoing.detail.to-university');
            case Order::ORDER_STATUS_ARRIVED_UNIVERSITY :
                return view('pages.sprinter.order.ongoing.detail.arrived-university');
            case Order::ORDER_STATUS_LEGAL_PROCESSING :
                return view('pages.sprinter.order.ongoing.detail.legal');
            case Order::ORDER_STATUS_LEGAL_PROCESSED :
                return view('pages.sprinter.order.ongoing.detail.legal-done');
            case Order::ORDER_STATUS_PACKING :
                return view('pages.sprinter.order.ongoing.detail.packing');
            case Order::ORDER_STATUS_PACKED :
                return view('pages.sprinter.order.ongoing.detail.packed');
            default:
                return view('pages.sprinter.order.ongoing.detail.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
