<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Jobs\Transaction\Invoice\UploadInvoicePaymentConfirmation;
use App\Models\PaymentMethod\Account;
use App\Models\PaymentMethod\PaymentMethod;
use App\Models\PaymentMethod\Type;
use App\Models\Transaction\Invoice\Invoice;
use App\Supports\InvoiceSupport;
use App\Supports\Notification\ToastSupport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request, Invoice $invoice)
    {
        $job = new UploadInvoicePaymentConfirmation($invoice, $request->all());
        DB::transaction(function () use ($job) {
            $this->dispatch($job);
        });
        ToastSupport::add("Mohon tunggu admin untuk melakukan konfirmasi", "Konfirmasi Pembayaran");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Invoice $invoice
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Invoice $invoice)
    {
        /** @var Account $account */
        $account = $invoice->account;
        $type = $account->type;

        $data = [
            'invoice' => $invoice,
            'account' => $account,
            'paymentMethod' => $account->paymentMethod,
            'type' => $type,
            'calc' => InvoiceSupport::calculateInvoice($invoice)
        ];

        switch (true) {
            case $type->type === PaymentMethod::TYPE_QRIS:
                return view('pages.invoice.payment.qris', $data);
            default:
                return view('pages.invoice.payment.transfer', $data);
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
