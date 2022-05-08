<?php

namespace App\Http\Controllers;

use App\Jobs\Transaction\Invoice\UpdateInvoicePaymentMethod;
use App\Jobs\Transaction\Invoice\UpdateInvoiceStatus;
use App\Models\Master\Faculty;
use App\Models\Master\User\User;
use App\Models\Transaction\Invoice\Invoice;
use App\Models\Transaction\Transaction;
use App\Supports\InvoiceSupport;
use App\Supports\PaymentMethodSupport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class InvoiceController extends Controller
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
        $job = new UpdateInvoicePaymentMethod($invoice, $request->all());
        $this->dispatch($job);
        return redirect(route('invoice.payment', Route::current()->parameters()));
    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        /** @var User $user */
        $user = auth()->user();
        /** @var \App\Models\Master\User\Detail $detail */
        $detail = $user->detail;
        /** @var Faculty $faculty */
        $faculty = $detail->faculty;

        $paymentMethodAccounts = PaymentMethodSupport::getPaymentMethodListByFaculty($faculty);
        $data = [
            'paymentMethods' => $paymentMethodAccounts->toArray(),
            'invoice' => $invoice,
            'invoiceDetails' => InvoiceSupport::calculateInvoice($invoice)
        ];
        return view("pages.invoice.index", $data);
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
