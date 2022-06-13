<?php

namespace App\Supports\Repositories\AdminRepository;

use App\Models\Master\Admin;
use App\Models\Transaction\Transaction;
use Illuminate\Database\Eloquent\Builder;

class Query
{
    public Admin $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function transactionQuery()
    {
        return Transaction::query()->whereHas('university', function (Builder $query) {
            $query->whereHas('admins', function (Builder $query) {
                $query->where(Admin::getTableName().'.'.Admin::getInstance()->getKeyName(), $this->admin->id);
            });
        });
    }
}
