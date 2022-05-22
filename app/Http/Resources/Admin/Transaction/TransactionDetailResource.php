<?php

namespace App\Http\Resources\Admin\Transaction;

use App\Models\Transaction\Invoice\Invoice;
use App\Models\Transaction\Transaction;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'invoices'
        ]);
        /** @var Invoice $invoice */
        $invoice = $transaction->invoices->first();
        $data = $transaction->toArray();
        $data['invoice'] = $invoice->toArray();
        $data['partner_shipment'] = "[" . strtoupper($data['partner_shipment_code']) . "] " . $data['partner_shipment_service'] . " " . preg_replace('/[^0-9]/', '', $data['partner_shipment_etd']) . " Hari (" . number_format($data['partner_shipment_price']) . ")";
        return $data;
    }
}
