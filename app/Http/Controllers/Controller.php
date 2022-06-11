<?php

namespace App\Http\Controllers;

use App\Supports\Repositories\AuthRepository;
use App\Supports\Repositories\TransactionRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public AuthRepository $authRepository;
    public TransactionRepository $transactionRepository;

    public function __construct(AuthRepository $authRepository, TransactionRepository $transactionRepository)
    {
        $this->authRepository = $authRepository;
        $this->transactionRepository = $transactionRepository;
    }
}
