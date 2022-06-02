@php
    /** @var \App\Models\Transaction\Transaction | \App\Http\Resources\Admin\Transaction\TransactionResource $transaction */
@endphp

<x-wrapper.card>
    <div class="row align-items-center">
        <div class="col-8">
            <div class="d-flex flex-column">
                <span class="font-weight-bold">#{{$transaction->token}}</span>
                <span>{{$transaction->university->name}}</span>
                <span class="font-weight-bold">
                            <x-display.display-currency amount="{{$transaction->invoice->calculated['total']??0}}"/>
                </span>
            </div>
        </div>
        <div class="col-4 text-right">
            <x-form.button size="{{\App\View\Components\Form\Button::SIZE_SMALL}}"
                           type="{{\App\View\Components\Form\Button::TYPE_INFO}}" outline>
                ambil
            </x-form.button>
        </div>
    </div>

</x-wrapper.card>
