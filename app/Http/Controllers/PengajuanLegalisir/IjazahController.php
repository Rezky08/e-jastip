<?php

namespace App\Http\Controllers\PengajuanLegalisir;

use App\Http\Controllers\Controller;
use App\Jobs\Transaction\Transaction\CreateTransaction;
use App\Models\Transaction\Transaction;
use App\Models\Transaction\Invoice\Invoice;
use Illuminate\Http\Request;
use Jalameta\Attachments\Concerns\AttachmentCreator;

class IjazahController extends Controller
{
    use AttachmentCreator;
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.pengajuan-legalisir.ijazah.index");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $job = new CreateTransaction($request->all());
        $this->dispatch($job);

        /** @var Transaction $transaction */
        $transaction = $job->transaction;
        $transaction->refresh();

        /** @var Invoice $invoice */
        $invoice = $transaction->invoices->first();

        if ($invoice->exists){
            return redirect()->to("/invoice/{$invoice->id}");
        }
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
