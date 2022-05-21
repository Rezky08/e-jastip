<?php

namespace App\Http\Controllers\PengajuanLegalisir;

use App\Http\Controllers\Controller;
use App\Jobs\Transaction\Transaction\CreateTransaction;
use App\Models\Master\User\User;
use App\Models\Transaction\Transaction;
use App\Models\Transaction\Invoice\Invoice;
use App\Supports\FormSupport;
use App\Supports\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function create(AuthRepository $repository)
    {
        /** @var User $user */
        $user = $repository->getUser();
        $university = $user->university;
        $form = [
            'origin_province_id' => $university->province_id,
            'origin_city_id' => $university->city_id,
            'origin_district_id' => $university->district_id,
            'origin_zip_code' => $university->zip_code,
            'origin_address' => $university->address,
            'university_id' => $user->university->id,
            'name' => $user->detail->name
        ];
        FormSupport::storeFormData($form);
        $data = [
            'user' => $user
        ];
        return view("pages.pengajuan-legalisir.ijazah.index", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $job = new CreateTransaction($request->all());

        DB::transaction(function () use (&$job, $request) {
            $this->dispatch($job);
        });
        /** @var Transaction $transaction */
        $transaction = $job->transaction;
        $transaction->refresh();

        /** @var Invoice $invoice */
        $invoice = $transaction->invoices->first();

        if ($invoice->exists) {
            return redirect()->to("/invoice/{$invoice->id}");
        } else {
            return redirect()->back();
        }
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
