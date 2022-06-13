<?php

namespace App\Supports\Repositories\SprinterRepository;

use App\Models\Master\Sprinter;
use App\Models\Transaction\Order;
use App\Models\Transaction\Transaction;
use Illuminate\Database\Eloquent\Builder;

class Query
{
    public Sprinter $sprinter;
    public Builder $query;

    public function __construct(Sprinter $sprinter)
    {
        $this->sprinter = $sprinter;
    }

    public function transactionQuery(): static
    {
        $this->query = Transaction::query()->whereHas('university', function (Builder $query) {
            $query->whereHas('sprinters', function (Builder $query) {
                $query->where(Sprinter::getTableName() . '.' . Sprinter::getInstance()->getKeyName(), $this->sprinter->id);
            });
        });
        return $this;
    }

    public function getIncomingTransaction(): Builder
    {
        return $this->query->whereDoesntHave('order')->where('status', Transaction::TRANSACTION_STATUS_PAID);
    }

    public function getOngoingTransaction(): Builder
    {
        return $this->query->whereHas('order', function (Builder $query) {
            $query->where('sprinter_id', $this->sprinter->id);
            $query->where('status','!=', Order::ORDER_STATUS_DONE);
        });
    }
}
