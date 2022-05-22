<?php

namespace App\View\Components\Badges;

use App\Models\Transaction\Invoice\Invoice;
use App\View\Components\Wrapper\Badge;
use Illuminate\Support\Arr;


class InvoicePaymentStatus extends Badge
{
    public function __construct(string $variant = "", string $type = null, string $size = null, bool $pill = true, $status = Invoice::INVOICE_STATUS_CREATED)
    {
        parent::__construct($variant, $type, $size, $pill);
        $this->content = Invoice::getAvailableStatus()[$status];
        switch (true) {
            case in_array($status, [Invoice::INVOICE_STATUS_WAITING_PAYMENT, Invoice::INVOICE_STATUS_WAITING_CONFIRMATION]):
                $this->type = self::TYPE_WARNING;
                break;
            case in_array($status, [Invoice::INVOICE_STATUS_CREATED, Invoice::INVOICE_STATUS_CONFIRMED]):
                $this->type = self::TYPE_INFO;
                break;
            case in_array($status, [Invoice::INVOICE_STATUS_CANCELED, Invoice::INVOICE_STATUS_EXPIRED]):
                $this->type = self::TYPE_DANGER;
                break;
            case in_array($status, [Invoice::INVOICE_STATUS_PAID]):
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
