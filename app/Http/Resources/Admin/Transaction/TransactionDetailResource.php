<?php

namespace App\Http\Resources\Admin\Transaction;

use App\Models\Master\Admin;
use App\Models\Master\User\User;
use App\Models\Transaction\Invoice\Invoice;
use App\Models\Transaction\Transaction;
use Illuminate\Http\Resources\Json\JsonResource;
use Jalameta\Attachments\Entities\Attachment;

class TransactionDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var User|Admin $user */
        $user = $request->user();
        $isAdmin = $user instanceof Admin;
        /** @var Transaction $transaction */
        $transaction = $this->resource;
        $transaction->load([
            'documents',
            'university',
            'faculty',
            'studyProgram',
            'originProvince',
            'originCity',
            'originDistrict',
            'destinationProvince',
            'destinationCity',
            'destinationDistrict',
            'user.detail',
            'invoice',
            'invoice.account',
            'invoice.account.paymentMethod',
            'order',
            'order.sprinter',
            'order.sprinter.detail',
        ]);

        $transaction->invoice->append('calculated');

        if (!empty($transaction->invoice->attachment)){
            $invoiceAttachmentUrl = route($isAdmin ? 'admin.attachment' : 'attachment', ['attachment' => $transaction->invoice->attachment->id]);
            $data = $transaction->toArray();
            $data['invoice']['attachment']['holder_name'] = $transaction->invoice->attachment->pivot->holder_name;
            $data['invoice']['attachment_url'] = $invoiceAttachmentUrl;
        }else{
            $data = $transaction->toArray();
        }

        $data['partner_shipment'] = "[" . strtoupper($data['partner_shipment_code']) . "] " . $data['partner_shipment_service'] . " " . preg_replace('/[^0-9]/', '', $data['partner_shipment_etd']) . " Hari (" . number_format($data['partner_shipment_price']) . ")";
        return $data;
    }
}
