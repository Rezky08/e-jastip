<?php

namespace App\Events\Transaction\Invoice;

use App\Models\Transaction\Invoice\Invoice;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Jalameta\Attachments\Entities\Attachment;

class InvoicePaymentConfirmationUploaded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Invoice $invoice;
    public Attachment $attachment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice, Attachment $attachment)
    {
        $this->invoice = $invoice;
        $this->attachment = $attachment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
