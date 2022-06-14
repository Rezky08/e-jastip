<?php

namespace App\Supports\Repositories;

use App\Models\Master\Admin;
use App\Models\Master\Sprinter\Sprinter;
use App\Models\Master\User\User;
use App\Supports\Repositories\AdminRepository\Query as AdminQuery;
use App\Supports\Repositories\SprinterRepository\Query as SprinterQuery;
use App\Supports\Repositories\UserRepository\Query as UserQuery;

class TransactionRepository
{

    public AuthRepository|null $authRepository;

    /**
     * @param AuthRepository|null $authRepository
     */
    public function __construct(AuthRepository|null $authRepository = null)
    {
        $this->authRepository = $authRepository;
    }

    public function setAuthRepository(AuthRepository $repository)
    {
        $this->authRepository = $repository;
    }

    public function queries(): \Illuminate\Database\Eloquent\Builder|AdminQuery|SprinterQuery|UserQuery|null
    {
        return $this->getQuery();
    }

    protected function getQuery()
    {
        if ($this->authRepository->isAdmin()) {
            /** @var Admin $user */
            $user = $this->authRepository->getUser();
            return (new AdminQuery($user))->transactionQuery();
        } elseif($this->authRepository->isSprinter()) {
            /** @var Sprinter $user */
            $user = $this->authRepository->getUser();
            return (new SprinterQuery($user))->transactionQuery();
        }else {
            /** @var User $user */
            $user = $this->authRepository->getUser();
            return (new UserQuery($user))->transactionQuery();
        }
    }

}
