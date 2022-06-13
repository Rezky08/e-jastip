<?php

namespace App\Http\Controllers\Sprinter\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Transaction\TransactionResource;
use App\Jobs\Transaction\Order\TakeTransactionOrder;
use App\Models\Master\Sprinter;
use App\Models\Transaction\Transaction;
use App\Supports\Notification\ToastSupport;
use App\Supports\Repositories\AuthRepository;
use App\Supports\Repositories\SprinterRepository\Query;
use App\Supports\Repositories\TransactionRepository;
use App\Traits\usePagination;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Rezky\LaravelResponseFormatter\Http\Response;

class IncomingController extends Controller
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
        $query = $query->getIncomingTransaction();

        /** @var LengthAwarePaginator $transactions */
        $transactions = $this->withPagination($query, TransactionResource::class, Response::PAGINATOR_TYPE_DEFAULT, 5);
        if ($request->expectsJson()) {
            /** @var JsonResponse $transactions */

            return $transactions;
        }
        $data = [
            'data' => $transactions
        ];


        return view('pages.sprinter.order.incoming.index', $data);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Transaction $transaction)
    {
        /** @var Sprinter $user */
        $user = $this->authRepository->getUser();
        try {
            $job = new TakeTransactionOrder($user, $transaction);
            DB::transaction(function () use ($user, $transaction, &$job) {
                $this->dispatch($job);
            });
        } catch (\Exception $e) {
            ToastSupport::add($e->getMessage(), __("messages.sprinter.order.incoming"));
            throw $e;
        }
        ToastSupport::add(__('logs.order.taken', ['name' => $user->name]), __("messages.sprinter.order.incoming"));

        return redirect()->back();
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
