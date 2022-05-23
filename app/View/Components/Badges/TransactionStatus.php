<?php

namespace App\View\Components\Badges;

use App\Models\Transaction\Invoice\Invoice;
use App\Models\Transaction\Transaction;
use App\View\Components\Wrapper\Badge;
use Illuminate\Support\Arr;


class TransactionStatus extends Badge
{
    public function __construct(string $variant = "", string $type = null, string $size = null, bool $pill = true, $status = Transaction::TRANSACTION_STATUS_CREATED)
    {
        parent::__construct($variant, $type, $size, $pill);
        $this->content = Invoice::getAvailableStatus()[$status];
        switch (true) {
            case in_array($status, [Transaction::TRANSACTION_STATUS_WAITING_PAYMENT,Transaction::TRANSACTION_STATUS_WAITING_PICKUP,Transaction::TRANSACTION_STATUS_IN_SHIPPING,Transaction::TRANSACTION_STATUS_IN_PROGRESS]):
                $this->type = self::TYPE_WARNING;
                break;
            case in_array($status, [Transaction::TRANSACTION_STATUS_CONFIRMED, Transaction::TRANSACTION_STATUS_CREATED]):
                $this->type = self::TYPE_INFO;
                break;
            case in_array($status, []):
                $this->type = self::TYPE_DANGER;
                break;
            case in_array($status, [Invoice::INVOICE_STATUS_PAID,Transaction::TRANSACTION_STATUS_FINISHED,Transaction::TRANSACTION_STATUS_DONE]):
                $this->type = self::TYPE_SUCCESS;
                break;
            default:
                $this->type = self::TYPE_PRIMARY;
                break;
        }
        $this->type = $this->getType()[$this->type];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.wrapper.badge');
    }
}
