<?php

namespace App\Http\Controllers\Sprinter\Order\Ongoing;

use App\Http\Controllers\Controller;
use App\Jobs\Transaction\Order\SprinterPrintDocument;
use App\Jobs\Transaction\Order\SprinterToUniversity;
use App\Models\Master\Sprinter;
use App\Models\Transaction\Order;
use App\Supports\Notification\ToastSupport;
use App\Supports\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToUniversityController extends Controller
{
    public AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

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
        DB::transaction(function () use ($order) {
            try {
                /** @var Sprinter $user */
                $user = $this->authRepository->getUser();
                $job = new SprinterToUniversity($user,$order);
                $this->dispatch($job);
            } catch (\Exception $e) {
                ToastSupport::add($e->getMessage(),__('messages.sprinter.order.ongoing'));
                throw $e;
            }
        });
        ToastSupport::add(__('messages.sprinter.form.submit.to_university'),__('messages.sprinter.order.ongoing'));
        return redirect()->back();

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
