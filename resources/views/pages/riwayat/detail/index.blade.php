@extends('pages.admin.pengajuan-legalisir.ijazah.detail.index')
@section("actions")
    <div class="d-flex flex-column" style="gap: 1rem">
        @if(\App\Supports\FormSupport::getFormData('status') === \App\Models\Transaction\Transaction::TRANSACTION_STATUS_CREATED)
            <a class="text-decoration-none"
               href="{{route('invoice.method',['invoice'=>\App\Supports\FormSupport::getFormData('invoice.id')])}}">
                <x-form.button :isSubmit="false" fullWidth>
                    Bayar
                </x-form.button>
            </a>
        @endif
        @if(\App\Supports\FormSupport::getFormData('status') === \App\Models\Transaction\Transaction::TRANSACTION_STATUS_WAITING_PAYMENT)
            <a class="text-decoration-none"
               href="{{route('invoice.payment',['invoice'=>\App\Supports\FormSupport::getFormData('invoice.id')])}}">
                <x-form.button :isSubmit="false" fullWidth>
                    Lihat Status Pembayaran
                </x-form.button>
            </a>
        @endif
        @if(\App\Supports\FormSupport::getFormData('status') >= \App\Models\Transaction\Transaction::TRANSACTION_STATUS_IN_PROGRESS)
            <a class="text-decoration-none"
               href="{{route('riwayat.log',['transaction'=>\App\Supports\FormSupport::getFormData('id')])}}">
                <x-form.button :isSubmit="false" fullWidth type="{{\App\View\Components\Form\Button::TYPE_SECONDARY}}"
                               outline>
                    {{__('messages.button.show.log')}}
                </x-form.button>
            </a>
        @endif
        @if(!empty(\App\Supports\FormSupport::getFormData('order')))
            @if(\App\Supports\FormSupport::getFormData('order.status') == \App\Models\Transaction\Order::ORDER_STATUS_SHIPPING)
                <a class="text-decoration-none"
                   href="{{route('riwayat.order.receive',['order'=>\App\Supports\FormSupport::getFormData('order.id')])}}">
                    <x-form.button :isSubmit="false" fullWidth
                                   type="{{\App\View\Components\Form\Button::TYPE_PRIMARY}}">
                        {{ucwords(__('messages.button.show.received'))}}
                    </x-form.button>
                </a>
            @endif
        @endif

    </div>
@endsection
