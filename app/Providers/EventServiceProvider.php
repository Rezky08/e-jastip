<?php

namespace App\Providers;

use App\Events\Master\User\UserCreated;
use App\Events\Transaction\Invoice\InvoicePaymentMethodUpdated;
use App\Events\Transaction\Transaction\TransactionCreated;
use App\Listeners\Master\User\UpdateOrCreateUserDetailByEvent;
use App\Listeners\Transaction\Invoice\GenerateInvoice;
use App\Listeners\Transaction\Invoice\UpdateInvoiceStatusByEvent;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TransactionCreated::class => [
            GenerateInvoice::class
        ],
        UserCreated::class => [
            UpdateOrCreateUserDetailByEvent::class
        ],
        InvoicePaymentMethodUpdated::class => [
            UpdateInvoiceStatusByEvent::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
