<?php

namespace App\Http\Controllers\Admin\PengajuanLegalisir;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Transaction\TransactionDetailResource;
use App\Http\Resources\Admin\Transaction\TransactionResource;
use App\Models\Master\Admin;
use App\Models\Transaction\Transaction;
use App\Supports\FormSupport;
use App\Supports\Repositories\AuthRepository;
use App\Supports\Repositories\TransactionRepository;
use App\Traits\usePagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Rezky\LaravelResponseFormatter\Http\Response;

class IjazahController extends Controller
{
    use usePagination;

    public TransactionRepository $transactionRepository;
    public AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository,TransactionRepository $transactionRepository)
    {

        $this->transactionRepository = $transactionRepository;
        $this->authRepository = $authRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Rezky\LaravelResponseFormatter\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $query = $this->transactionRepository->queries();
            return $this->withPagination($query, TransactionResource::class, Response::PAGINATOR_TYPE_DATA_TABLE);
        }
        $data = [
            'tables' => [
                'transactionTable' => [
                    'Token' => 'token',
                    'NIM' => 'user.student_id',
                    'Nama' => 'user.name',
                    'Fakultas' => 'faculty.name',
                    'Program Studi' => 'study_program.name',
                    'Status' => 'status_label',
                    'Aksi' => null,
                ],
                'documentsTable' => [
                    'Nama Dokumen' => 'name',
                    'Aksi' => null,
                ],

            ]

        ];
        return view("pages.admin.pengajuan-legalisir.ijazah.index", $data);
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
     * Display the specified resource.
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$transaction)
    {
        $form = TransactionDetailResource::make($transaction)->toArray($request);
        FormSupport::storeFormData($form);
        return view('pages.admin.pengajuan-legalisir.ijazah.detail.index');
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
