<?php

namespace App\Http\Controllers\Admin\Invoice;

use App\Http\Controllers\Controller;
use App\Jobs\Transaction\Invoice\ConfirmInvoicePayment;
use App\Models\Transaction\Invoice\Invoice;
use App\Supports\Notification\ToastSupport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use mysql_xdevapi\Exception;

class PaymentController extends Controller
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
    public function store(Request $request, Invoice $invoice)
    {
        DB::transaction(function () use ($invoice) {
            try {
                $job = new ConfirmInvoicePayment($invoice);
                $this->dispatch($job);
            } catch (\Exception $exception) {
                ToastSupport::add($exception->getMessage(), __('messages.invoice.payment.confirmation.title'));
                throw $exception;
            }
        });
        ToastSupport::add(__('messages.notification.submit.success', ['title' => __('messages.invoice.payment.confirmation.title'), 'id' => "#" . $invoice->id]), __('messages.invoice.payment.confirmation.title'));

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
