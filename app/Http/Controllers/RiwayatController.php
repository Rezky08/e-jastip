<?php

namespace App\Http\Controllers;

use App\Http\Resources\Admin\Transaction\TransactionDetailResource;
use App\Http\Resources\Admin\Transaction\TransactionResource;
use App\Http\Resources\Master\UniversityOptionResource;
use App\Models\Master\University;
use App\Models\Master\User\User;
use App\Models\Transaction\Invoice\Invoice;
use App\Models\Transaction\Transaction;
use App\Supports\FormSupport;
use App\Supports\Repositories\AuthRepository;
use App\Supports\Repositories\TransactionRepository;
use App\Traits\DataSearchResourceable;
use App\Traits\usePagination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Rezky\LaravelResponseFormatter\Http\Response;

class RiwayatController extends Controller
{
    use usePagination, DataSearchResourceable;

    public AuthRepository $authRepository;
    public TransactionRepository $transactionRepository;

    public function __construct(AuthRepository $authRepository, TransactionRepository $transactionRepository)
    {
        $this->authRepository = $authRepository;
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\JsonResponse|Response
     */
    public function index(Request $request)
    {

        if ($request->expectsJson()) {
            $query = $this->transactionRepository->queries();
            $searchFields = [
                'token,student_id,name,faculty.name,faculty.code,studyProgram.name' => 'search.value',
            ];
            return $this->search($request, $query, $searchFields, ['id'], TransactionResource::class, Response::PAGINATOR_TYPE_DATA_TABLE);
        }
        $data = [
            'tables' => [
                'transactionTable' => [
                    'Token' => 'token',
                    'NIM' => 'student_id',
                    'Nama' => 'name',
                    'Fakultas' => ['data' => 'faculty.name', 'name' => 'faculty_id'],
                    'Program Studi' => ['data' => 'study_program.name', 'name' => 'study_program_id'],
                    'Status' => ['data' => 'status_label', 'name' => 'status'],
                    'Aksi' => null,
                ],
                'documentsTable' => [
                    'Nama Dokumen' => 'name',
                    'Aksi' => null,
                ],

            ]

        ];
        return view("pages.riwayat.index", $data);
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
     * @param Request $request
     * @param $transaction
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function show(Request $request,Transaction $transaction): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        /** @var Invoice $invoice */
        $invoice = $transaction->invoice;
        $form = TransactionDetailResource::make($transaction)->toArray($request);
        FormSupport::storeFormData($form);
        return view('pages.riwayat.detail.index');
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
