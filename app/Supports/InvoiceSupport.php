<?php

namespace App\Supports;

use App\Models\Transaction\Invoice\Detail;
use App\Models\Transaction\Invoice\Invoice;
use Illuminate\Support\Collection;

class InvoiceSupport
{
    static public function calculateInvoice(Invoice $invoice): array
    {
        /** @var Collection $items */
        $items = $invoice->details->where('type', '!=', Detail::INVOICE_DETAIL_TYPE_DISCOUNT);
        /** @var Collection $discounts */
        $discounts = $invoice->details->where('type', Detail::INVOICE_DETAIL_TYPE_DISCOUNT);
        $invoiceDetails = [
            'items' => $items,
            'discounts' => $discounts,
            'total' => bcsub($items->pluck('price')->sum(), $discounts->pluck('price')->sum())
        ];
        return $invoiceDetails;
    }

    static public function getCalculatePercentageValue($amount = 0, $percentage = 0)
    {
        $percentage = bcdiv($percentage, 100,2);
        return bcmul($amount, $percentage);
    }
}
