<?php

namespace App\Http\Controllers\Riwayat;

use App\Http\Controllers\Controller;
use App\Jobs\Transaction\Order\UserReceiveDocument;
use App\Models\Master\User\User;
use App\Models\Transaction\Order;
use App\Models\Transaction\Transaction;
use App\Supports\Notification\ToastSupport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, Order $order)
    {
        /** @var User $user */
        $user = $this->authRepository->getUser();
        $job = new UserReceiveDocument($user, $order);
        DB::transaction(function () use ($job) {
            try {
                $this->dispatch($job);
            } catch (\Exception $exception) {
                ToastSupport::add($exception->getMessage(),__('messages.title.history'));
                throw $exception;
            }
        });
        ToastSupport::add(__('messages.button.show.received'),__('messages.title.history'));

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
