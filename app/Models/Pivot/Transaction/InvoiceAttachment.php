<?php

namespace App\Models\Pivot\Transaction;

use App\Models\Transaction\Invoice\Invoice;
use App\Traits\HasTable;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Jalameta\Attachments\Entities\Attachment;

/**
 * @property string $holder_name
 */
class InvoiceAttachment extends Pivot
{
    use HasTable;

    protected $table = "t_invoice_attachments";

    protected $casts = [
        'attachment_id' => 'string',
        'invoice_id' => 'string',
    ];

    public function attachment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Attachment::class, 'attachment_id', 'id');
    }

    public function invoice(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }
}
