<?php

namespace App\Http\Controllers;

use App\Models\Master\Faculty;
use App\Models\PaymentMethod\Account;
use App\Models\PaymentMethod\Type;
use App\Models\Temporary\Transaction;
use App\Models\Transaction\Invoice\Detail;
use App\Models\Transaction\Invoice\Invoice;
use App\Supports\PaymentMethodSupport;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        return redirect()->to("/invoice/1/payment");
    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        /** @var Collection $items */
        $items = $invoice->details->where('type','!=',Detail::INVOICE_DETAIL_TYPE_DISCOUNT);
        /** @var Collection $discounts */
        $discounts = $invoice->details->where('type',Detail::INVOICE_DETAIL_TYPE_DISCOUNT);
        $invoiceDetails = [
            'items' => $items,
            'discounts' => $discounts,
            'total' => bcsub($items->pluck('price')->sum(),$discounts->pluck('price')->sum())
        ];
        /** @var Faculty $faculty */
        $faculty = Faculty::query()->inRandomOrder()->firstOrFail();
        $paymentMethodAccounts = PaymentMethodSupport::getPaymentMethodListByFaculty($faculty);
        $data = [
            'paymentMethods' => $paymentMethodAccounts->toArray(),
            'invoice' => $invoice,
            'invoiceDetails' => $invoiceDetails
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
