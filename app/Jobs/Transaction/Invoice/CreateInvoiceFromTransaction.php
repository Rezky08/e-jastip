<?php

namespace App\Jobs\Transaction\Invoice;

use App\Contracts\InvoiceableContract;
use App\Models\Setting\Setting;
use App\Models\Transaction\Invoice\Detail;
use App\Models\Transaction\Invoice\Invoice;
use App\Supports\InvoiceSupport;
use App\Supports\SettingSupport;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Rezky\LaravelResponseFormatter\Exception\Error;
use Rezky\LaravelResponseFormatter\Http\Code;

class CreateInvoiceFromTransaction
{
    use Dispatchable, SerializesModels;

    protected array $attributes;
    protected int $status;
    public InvoiceableContract $invoiceable;
    public Invoice $invoice;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(InvoiceableContract $invoiceable, $status = Invoice::INVOICE_STATUS_CREATED, $attributes = [])
    {
        //
        $this->attributes = $attributes;
        $this->invoiceable = $invoiceable;
        $this->status = $status;
    }

    /**
     * Execute the job.
     *
     * @return bool
     * @throws \Throwable
     */
    public function handle(): bool
    {
        $job = new CreateInvoice($this->attributes, $this->status);
        dispatch($job);
        throw_if(!$job->invoice->exists, Error::make(Code::CODE_ERROR_INVALID_DATA));
        $this->invoice = $job->invoice;


        // Get biaya layanan dari m_settings
        $settingService = SettingSupport::getSettingByKey(Setting::KEY_BIAYA_LAYANAN);

        // Get biaya aplikasi dari m_settings
        $settingAppFeePercentage = SettingSupport::getSettingByKey(Setting::KEY_BIAYA_APP_PERCENTAGE);
        $appFee = Detail::getAvailableType()[Setting::KEY_BIAYA_APP_PERCENTAGE];
        $appFee['price'] = InvoiceSupport::getCalculatePercentageValue($settingService, $settingAppFeePercentage);

        // Get biaya jastip dari m_settings
        $settingJastipFeePercentage = SettingSupport::getSettingByKey(Setting::KEY_BIAYA_JASTIP_PERCENTAGE);
        $jastipFee = Detail::getAvailableType()[Setting::KEY_BIAYA_JASTIP_PERCENTAGE];
        $jastipFee['price'] = InvoiceSupport::getCalculatePercentageValue($settingService, $settingJastipFeePercentage);

        // Get biaya ops dari m_settings
        $settingOpsFeePercentage = SettingSupport::getSettingByKey(Setting::KEY_BIAYA_OPS_PERCENTAGE);
        $opsFee = Detail::getAvailableType()[Setting::KEY_BIAYA_OPS_PERCENTAGE];
        $opsFee['price'] = InvoiceSupport::getCalculatePercentageValue($settingService, $settingOpsFeePercentage);

        // Get biaya kirim dari invoiceable
        /** @var Model $transaction */
        $transaction = $this->invoiceable;
        $deliveryFee = Detail::getAvailableType()[Detail::INVOICE_DETAIL_TYPE_SHIPMENT];
        $deliveryFee['price'] = $transaction->partner_shipment_price;

        $data = [$appFee, $jastipFee, $opsFee, $deliveryFee];

        // Store Invoice Detail Item
        $details = new Collection();
        foreach ($data as $item) {
            $detail = $this->invoice->details()->make($item);
            $details->add($detail);
        }
        $this->invoice->details()->saveMany($details);

        // Attach invoice ke invoiceable
        $this->invoiceable->invoices()->attach($this->invoice);

        return $this->invoice->exists;
    }
}
